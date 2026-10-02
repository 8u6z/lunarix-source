function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return '';
}

window.api = async function (url, method = 'GET', body = null) {
    const token = getCookie('_LUNARSECURITY');
    const options = {
        method,
        headers: {
            'Content-Type': 'application/json',
            'Authorization': token ? `Bearer ${token}` : undefined
        },
        credentials: 'same-origin'
    };

    if (body && (method === 'POST' || method === 'PUT')) {
        options.body = JSON.stringify(body);
    }

    try {
        const response = await fetch(url, options);
        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(errorData.message || `API call failed with status ${response.status}`);
        }
        return await response.json();
    } catch (error) {
        return { success: false, message: error.message };
    }
};

window.addFriend = async function(profileId) {
    const btn = document.querySelector(`button[onclick="addFriend(${profileId})"]`);
    if (!btn) return;
    btn.disabled = true;
    const res = await api(`/api/friends/${profileId}/add`, "POST");
    if (res.success) {
        btn.textContent = "Pending";
        btn.classList.add("disabled");
    } else {
        btn.disabled = false;
        btn.textContent = "Add Friend";
    }
};

window.unfriend = async function(profileId) {
    const btn = document.querySelector(`button[onclick="unfriend(${profileId})"]`);
    if (!btn) return;
    btn.disabled = true;

    try {
        const res = await api(`/api/friends/${profileId}/remove`, "POST");
        if (res.success) {
            btn.disabled = false;
            btn.textContent = "Add Friend";
            btn.classList.remove("btn-outline-danger");
            btn.classList.add("btn-primary");
            btn.setAttribute("onclick", `addFriend(${profileId})`);
        } else {
            btn.disabled = false;
            btn.textContent = "Unfriend";
        }
    } catch (err) {
        console.error(err);
        btn.disabled = false;
        btn.textContent = "Unfriend";
    }
};

window.acceptFriendRequest = async function(fromUserId) {
    const btn = document.querySelector(`button[onclick="acceptFriendRequest(${fromUserId})"]`);
    if (!btn) return;
    btn.disabled = true;
    const res = await api(`/api/friends/request/${fromUserId}/accept`, "POST");
    if (res.success) {
        btn.disabled = false;
        btn.textContent = "Unfriend";
        btn.classList.remove("btn-success");
        btn.classList.add("btn-outline-danger");
        btn.setAttribute("onclick", `unfriend(${fromUserId})`);
    } else {
        btn.disabled = false;
        btn.textContent = "Accept";
    }
};

document.addEventListener("DOMContentLoaded", function () {
    const group = document.getElementById('blurbinputgroup');
    if (!group) return;
    const display = document.getElementById('blurbdisplay');
    const applyBtn = document.getElementById('applyBlurbBtn');
    const blurbInput = document.getElementById('blurbinput');
    const blurbNotice = document.getElementById('blurbnotice');
    const bsCollapse = new bootstrap.Collapse(group, { toggle: false });
    document.querySelectorAll('.toggleStatusEditor').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            if (group.classList.contains('show')) {
                bsCollapse.hide();
                display.classList.remove('d-none');
            } else {
                bsCollapse.show();
                display.classList.add('d-none');
                group.offsetHeight;
                blurbInput.focus();
            }
        });
    });

    applyBtn.addEventListener('click', async () => {
        const blurb = blurbInput.value.trim();
        if (!blurb) return;
        applyBtn.disabled = true;
        try {
            const res = await fetch('/apis/update/blurb', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                credentials: 'same-origin',
                body: JSON.stringify({ blurb })
            });

            const data = await res.json();
            if (!data.success) throw new Error(data.message);

            display.textContent = `"${blurb}"`;
            bsCollapse.hide();
            display.classList.remove('d-none');
            blurbInput.value = '';
        } catch (err) {
            blurbNotice.textContent = err.message || 'Failed to update blurb';
            blurbNotice.classList.add('text-danger');
            blurbInput.classList.add('is-invalid');
        } finally {
            applyBtn.disabled = false;
        }
    });

    blurbInput.addEventListener('input', () => {
        blurbInput.classList.remove('is-invalid');
        blurbNotice.classList.remove('text-danger');
        blurbNotice.textContent = 'Do not put any sensitive information here.';
    });
});