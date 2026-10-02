<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <title>Lunarix - the hangout spot for the swarm!!1!1!11!!!!</title>
</head>
<body class="bg-body-tertiary m-0">
<main class="container-fluid vh-100 p-0">
    <div class="row h-100 g-0 m-0">
        <div class="col-lg-3 d-flex align-items-center justify-content-center p-0">
            <div class="w-100 px-4" style="max-width: 380px;">
                <form method="POST" action="/landing/signup">
                @csrf
                    <div class="text-center mb-4">
                        <img src="/img/logo_full.png" alt="Lunarix" width="180" class="mb-3">
                        <p class="text-body-secondary">A Hangout spot for the Swarm community.</p>
                    </div>
                    @if(env('LUNARIX_CREATE_ACCOUNT', false))
                    <div class="mb-2">
                        <label class="form-label">Birthday</label>
                        <div class="row g-2">
                            <div class="col-5">
                                <select class="form-select" name="lstMonths" autocomplete="off" data-last-selected="" required>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select class="form-select" name="lstDays" autocomplete="off" data-last-selected="" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-select" name="lstYears" autocomplete="off" data-last-selected="" required>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                    <option value="2009">2009</option>
                                    <option value="2008">2008</option>
                                    <option value="2007">2007</option>
                                    <option value="2006">2006</option>
                                    <option value="2005">2005</option>
                                    <option value="2004">2004</option>
                                    <option value="2003">2003</option>
                                    <option value="2002">2002</option>
                                    <option value="2001">2001</option>
                                    <option value="2000">2000</option>
                                    <option value="1999">1999</option>
                                    <option value="1998">1998</option>
                                    <option value="1997">1997</option>
                                    <option value="1996">1996</option>
                                    <option value="1995">1995</option>
                                    <option value="1994">1994</option>
                                    <option value="1993">1993</option>
                                    <option value="1992">1992</option>
                                    <option value="1991">1991</option>
                                    <option value="1990">1990</option>
                                    <option value="1989">1989</option>
                                    <option value="1988">1988</option>
                                    <option value="1987">1987</option>
                                    <option value="1986">1986</option>
                                    <option value="1985">1985</option>
                                    <option value="1984">1984</option>
                                    <option value="1983">1983</option>
                                    <option value="1982">1982</option>
                                    <option value="1981">1981</option>
                                    <option value="1980">1980</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="SignupUsername" name="userName" placeholder="Username" required>
                        <label for="SignupUsername">Username</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="SignupPassword" name="password" required>
                        <label for="SignupPassword">Password</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="SignupPasswordConfirm" name="passwordConfirm" required>
                        <label for="SignupPasswordConfirm">Confirm Password</label>
                    </div>
                    @if(config('app.access_key_enabled'))
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="AccessKey" name="accesskey" placeholder="Lunar-XXXXXXXXXXXX-AccessKey" required>
                        <label for="accesskey">Access Key</label>
                    </div>
                    @endif
                    <div class="form-floating mb-3">
                        <select class="form-select" id="GenderInput" name="gender" data-last-gender-male="False" data-last-gender-female="False" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <label for="gender">Gender</label>
                    </div>
                    @if(config('services.turnstile.enabled'))
                    <div class="form-floating mb-3">
                    <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-theme="dark"></div>
                    </div>
                    @endif
                    <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>
                    @else
                    <p class="text-danger">Sign ups are currently disabled, check back later!</p>
                    @endif
                    <div class="text-center mt-3">
                        <small class="text-body-secondary">Already have an account? <a href="/login">Sign in</a></small>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-9 d-none d-lg-block p-0">
            <img src="/img/conomy.png" alt="" class="w-100 h-100 object-fit-cover">
        </div>
    </div>
</main>
</body>
<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';
    const form = document.querySelector('form[action="/landing/signup"]');
    if (!form) {
        return;
    }
    const usernameInput = document.getElementById('SignupUsername');
    const passwordInput = document.getElementById('SignupPassword');
    const passwordConfirmInput = document.getElementById('SignupPasswordConfirm');
    const monthInput = document.querySelector('[name="lstMonths"]');
    const dayInput = document.querySelector('[name="lstDays"]');
    const yearInput = document.querySelector('[name="lstYears"]');
    const genderInput = document.getElementById('GenderInput');
    const submitButton = form.querySelector('button[type="submit"]');
    function isValidBirthday() {
        if (!monthInput || !dayInput || !yearInput) {
            return true;
        }
        const month = parseInt(monthInput.value, 10);
        const day = parseInt(dayInput.value, 10);
        const year = parseInt(yearInput.value, 10);
        if (!month || !day || !year) {
            return false;
        }
        const date = new Date(year, month - 1, day);
        if (date.getFullYear() !== year || date.getMonth() !== month - 1 || date.getDate() !== day) {
            return false;
        }
        return date.getTime() < Date.now();
    }
    function updateDays() {
        if (!monthInput || !dayInput || !yearInput) {
            return;
        }
        const month = parseInt(monthInput.value, 10);
        const year = parseInt(yearInput.value, 10);
        if (!month || !year) {
            return;
        }
        const currentDay = parseInt(dayInput.value, 10);
        const daysInMonth = new Date(year, month, 0).getDate();
        dayInput.querySelectorAll('option').forEach(function (option) {
            const day = parseInt(option.value, 10);
            option.disabled = day > daysInMonth;
        });
        if (currentDay > daysInMonth) {
            dayInput.value = String(daysInMonth);
        }
    }
    if (monthInput) {
        monthInput.addEventListener('change', updateDays);
    }
    if (yearInput) {
        yearInput.addEventListener('change', updateDays);
    }
    updateDays();
    function validateUsername(username) {
        username = username.trim();
        if (username.length < 3) {
            return 'Username is too short.';
        }
        if (username.length > 20) {
            return 'Username is too long.';
        }
        if (!/^[A-Za-z0-9_]+$/.test(username)) {
            return 'Username contains invalid characters.';
        }
        return '';
    }
    function validatePassword(password) {
        if (password.length < 6) {
            return 'Password is too short.';
        }
        if (/\s/.test(password)) {
            return 'Password cannot contain spaces.';
        }
        const letters = (password.match(/[A-Za-z]/g) || []).length;
        const numbers = (password.match(/[0-9]/g) || []).length;
        if (letters < 4) {
            return 'Password needs at least four letters.';
        }
        if (numbers < 2) {
            return 'Password needs at least two numbers.';
        }
        return '';
    }
    function setInvalid(input, message) {
        if (!input) {
            return;
        }
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
        let feedback = input.parentElement.querySelector('.invalid-feedback');
        if (!feedback) {
            feedback = document.createElement('div');
            feedback.className = 'invalid-feedback';
            input.parentElement.appendChild(feedback);
        }
        feedback.textContent = message;
    }
    function setValid(input) {
        if (!input) {
            return;
        }
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        const feedback = input.parentElement.querySelector('.invalid-feedback');
        if (feedback) {
            feedback.textContent = '';
        }
    }
    let usernameCheckValid = true;
    let usernameCheckPending = false;
    function checkUsernameAvailability(username) {
        usernameCheckPending = true;
        usernameCheckValid = false;
        fetch('/UserCheck/checkifinvalidusernameforsignup?username=' + encodeURIComponent(username))
            .then(function (res) { return res.json(); })
            .then(function (json) {
                usernameCheckPending = false;
                if (json.data === 1) {
                    setInvalid(usernameInput, 'Username is already taken.');
                    usernameCheckValid = false;
                } else if (json.data === 2) {
                    setInvalid(usernameInput, 'Username cannot be used.');
                    usernameCheckValid = false;
                } else {
                    setValid(usernameInput);
                    usernameCheckValid = true;
                }
            })
            .catch(function () {
                usernameCheckPending = false;
                usernameCheckValid = true;
            });
    }
    if (usernameInput) {
        usernameInput.addEventListener('blur', function () {
            if (usernameInput.value.trim() === '') {
                usernameInput.classList.remove('is-invalid', 'is-valid');
                usernameCheckValid = true;
                return;
            }
            const error = validateUsername(usernameInput.value);
            if (error) {
                setInvalid(usernameInput, error);
                usernameCheckValid = false;
            } else {
                checkUsernameAvailability(usernameInput.value.trim());
            }
        });
    }
    if (passwordInput) {
        passwordInput.addEventListener('blur', function () {
            if (passwordInput.value === '') {
                passwordInput.classList.remove('is-invalid', 'is-valid');
                return;
            }
            const error = validatePassword(passwordInput.value);
            if (error) {
                setInvalid(passwordInput, error);
            } else {
                setValid(passwordInput);
            }
        });
    }
    if (passwordConfirmInput) {
        passwordConfirmInput.addEventListener('blur', function () {
            if (passwordConfirmInput.value === '') {
                passwordConfirmInput.classList.remove('is-invalid', 'is-valid');
                return;
            }
            if (passwordConfirmInput.value !== passwordInput.value) {
                setInvalid(passwordConfirmInput, 'Passwords do not match.');
            } else {
                setValid(passwordConfirmInput);
            }
        });
        if (passwordInput) {
            passwordInput.addEventListener('input', function () {
                if (passwordConfirmInput.value === '') {
                    return;
                }
                if (passwordConfirmInput.value !== passwordInput.value) {
                    setInvalid(passwordConfirmInput, 'Passwords do not match.');
                } else {
                    setValid(passwordConfirmInput);
                }
            });
        }
    }
    [monthInput, dayInput, yearInput].forEach(function (input) {
        if (!input) {
            return;
        }
        input.addEventListener('change', function () {
            if (isValidBirthday()) {
                input.classList.remove('is-invalid');
            }
        });
    });
    form.addEventListener('submit', function (event) {
        let valid = true;
        if (usernameInput) {
            const localError = validateUsername(usernameInput.value);
            if (localError) {
                setInvalid(usernameInput, localError);
                valid = false;
            } else if (usernameCheckPending) {
                valid = false;
            } else if (!usernameCheckValid) {
                valid = false;
            } else {
                setValid(usernameInput);
            }
        }
        if (passwordInput) {
            const passwordError = validatePassword(passwordInput.value);
            if (passwordError) {
                setInvalid(passwordInput, passwordError);
                valid = false;
            } else {
                setValid(passwordInput);
            }
        }
        if (passwordConfirmInput) {
            if (passwordConfirmInput.value !== passwordInput.value) {
                setInvalid(passwordConfirmInput, 'Passwords do not match.');
                valid = false;
            } else {
                setValid(passwordConfirmInput);
            }
        }
        if (!isValidBirthday()) {
            [monthInput, dayInput, yearInput].forEach(function (input) {
                if (input) {
                    input.classList.add('is-invalid');
                }
            });
            valid = false;
        }
        if (genderInput && genderInput.value !== 'male' && genderInput.value !== 'female') {
            setInvalid(genderInput, 'Please select a gender.');
            valid = false;
        } else if (genderInput) {
            setValid(genderInput);
        }
        const turnstileInput = form.querySelector('[name="cf-turnstile-response"]');
        if (
            document.querySelector('.cf-turnstile') &&
            (!turnstileInput || !turnstileInput.value)
        ) {
            valid = false;
        }
        if (!valid) {
            event.preventDefault();
            const firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.focus();
            }
            return;
        }
        if (submitButton) {
            submitButton.disabled = true;
        }
    });
    const autofocus = form.querySelector('[autofocus]');
    if (autofocus && document.activeElement !== autofocus) {
        autofocus.focus();
    }
});
</script>
</html>