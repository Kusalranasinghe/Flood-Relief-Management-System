//confirmation and success helper
function confirmAction(message) {
  return confirm(message);
}

function showSuccess(message) {
  alert(message);
}

//scrol navbar
window.addEventListener("scroll", function () {
  const nav = document.querySelector(".navbar");
  if (nav) {
    if (window.scrollY > 50) {
      nav.classList.add("scrolled");
    } else {
      nav.classList.remove("scrolled");
    }
  }
});

//get ds div-requst form
function fetchDivisions(districtName) {
  var dsSelect = document.getElementById("ds_select");
  if (districtName === "") {
    dsSelect.innerHTML = '<option value="">Select District First</option>';
    return;
  }
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "get_divisions.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      dsSelect.innerHTML = xhr.responseText;
    }
  };
  xhr.send("district=" + districtName);
}

//mobile validation-requst form
const phoneInput = document.getElementById("phone_input");
const phoneError = document.getElementById("phone_error");

if (phoneInput) {
  phoneInput.addEventListener("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 9);
    if (this.value.length > 0 && this.value.length < 9) {
      phoneError.textContent = " Please enter exactly 9 digits.";
      phoneError.style.display = "block";
    } else {
      phoneError.style.display = "none";
    }
  });

  phoneInput.addEventListener("keypress", function (e) {
    if (!/[0-9]/.test(e.key)) {
      phoneError.textContent = " Numbers only. Letters are not allowed.";
      phoneError.style.display = "block";
      e.preventDefault();
    }
  });
}

//family member validation-requst form
const membersInput = document.getElementById("members_input");
const membersError = document.getElementById("members_error");

if (membersInput) {
  membersInput.addEventListener("input", function () {
    if (this.value <= 0 || this.value === "") {
      membersError.textContent =
        "⚠️ Must be a positive number (greater than 0).";
      membersError.style.display = "block";
    } else {
      membersError.style.display = "none";
    }
  });

  membersInput.addEventListener("keypress", function (e) {
    if (!/[0-9]/.test(e.key)) {
      membersError.textContent = " Numbers only. Letters are not allowed.";
      membersError.style.display = "block";
      e.preventDefault();
    }
  });
}

//nic validation-user registrr
const nicInput = document.getElementById("nic_input");
const nicError = document.getElementById("nic_error");

if (nicInput) {
  nicInput.addEventListener("input", function () {
    let val = this.value;

    const tenthCharIsLetter = val.length >= 10 && /[VvXx]/.test(val[9]);
    const allDigits = /^[0-9]+$/.test(val);

    if (tenthCharIsLetter) {
      this.value = val.slice(0, 10);
      val = this.value;
    } else if (allDigits) {
      this.value = val.slice(0, 12);
      val = this.value;
    } else {
      this.value = val.replace(/[^0-9VvXx]/g, "");
      val = this.value;
    }

    const nicPattern = /^([0-9]{9}[VvXx]|[0-9]{12})$/;
    const nicTick = document.getElementById("nic_tick");

    if (val.length === 0) {
      nicError.style.display = "none";
      nicTick.style.display = "none";
    } else if (nicPattern.test(val)) {
      nicError.style.display = "none";
      nicTick.style.display = "block";
    } else {
      nicError.textContent =
        "Enter a valid NIC. (Ex: 123456789V or 200012345678)";
      nicError.style.color = "#ff4d4d";
      nicError.style.display = "block";
      nicTick.style.display = "none";
    }
  });

  nicInput.addEventListener("keypress", function (e) {
    const val = this.value;
    const key = e.key;

    //v and x only at 10th
    if (/[VvXx]/.test(key)) {
      if (val.length !== 9 || !/^[0-9]{9}$/.test(val)) {
        e.preventDefault();
      }
      return;
    }

    //block letters
    if (!/[0-9]/.test(key)) {
      nicError.textContent =
        "Enter a valid NIC. (Ex: 123456789V or 200012345678)";
      nicError.style.color = "#ff4d4d";
      nicError.style.display = "block";
      e.preventDefault();
      return;
    }

    //block silently at max length
    const tenthIsLetter = val.length >= 10 && /[VvXx]/.test(val[9]);
    const maxLen = tenthIsLetter ? 10 : 12;
    if (val.length >= maxLen) {
      e.preventDefault();
    }
  });
}

//email validation-user reg
const regEmail = document.getElementById("reg_email");
const regEmailError = document.getElementById("reg_email_error");
const emailTick = document.getElementById("email_tick");

if (regEmail) {
  regEmail.addEventListener("input", function () {
    const val = this.value.trim();
    const emailPattern =
      /^[^\s@]+@(gmail\.com|yahoo\.com|hotmail\.com|outlook\.com|icloud\.com|live\.com|yahoo\.co\.uk|hotmail\.co\.uk)$/i;
    if (val.length === 0) {
      regEmailError.style.display = "none";
      emailTick.style.display = "none";
    } else if (emailPattern.test(val)) {
      regEmailError.style.display = "none";
      emailTick.style.display = "block";
    } else {
      regEmailError.textContent = " Please enter a valid email address.";
      regEmailError.style.display = "block";
      emailTick.style.display = "none";
    }
  });
}

//mobile validation-user reg
const regPhoneInput = document.getElementById("reg_phone_input");
const regPhoneError = document.getElementById("reg_phone_error");

if (regPhoneInput) {
    regPhoneInput.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);
        const regPhoneTick = document.getElementById('reg_phone_tick');
        if (this.value.length === 0) {
            regPhoneError.style.display = 'none';
            regPhoneTick.style.display = 'none';
        } else if (this.value.length < 9) {
            regPhoneError.textContent = ' Please enter exactly 9 digits.';
            regPhoneError.style.display = 'block';
            regPhoneTick.style.display = 'none';
        } else {
            regPhoneError.style.display = 'none';
            regPhoneTick.style.display = 'block';
        }
    });

    regPhoneInput.addEventListener('keypress', function (e) {
        const regPhoneTick = document.getElementById('reg_phone_tick');
        if (!/[0-9]/.test(e.key)) {
            //error at less than 9 numbers
            if (regPhoneInput.value.length < 9) {
                regPhoneError.textContent = ' Numbers only. Letters are not allowed.';
                regPhoneError.style.display = 'block';
            }
            e.preventDefault();
        }
    });
}

//pw validation-user reg
const regPassword = document.getElementById("reg_password");
const regPasswordError = document.getElementById("reg_password_error");

if (regPassword) {
    regPassword.addEventListener('input', function () {
        const passwordTick = document.getElementById('password_tick');
        if (this.value.length === 0) {
            regPasswordError.style.display = 'none';
            passwordTick.style.display = 'none';
        } else if (this.value.length < 6) {
            regPasswordError.style.display = 'block';
            passwordTick.style.display = 'none';
        } else {
            regPasswordError.style.display = 'none';
            passwordTick.style.display = 'block';
        }
    });
}

// ===== UPDATE FORM PHONE VALIDATION =====
const updatePhone = document.getElementById('update_phone');
const updatePhoneError = document.getElementById('update_phone_error');

if (updatePhone) {
    updatePhone.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);
        const updatePhoneTick = document.getElementById('update_phone_tick');
        if (this.value.length === 0) {
            updatePhoneError.style.display = 'none';
            updatePhoneTick.style.display = 'none';
        } else if (this.value.length < 9) {
            updatePhoneError.textContent = ' Please enter exactly 9 digits.';
            updatePhoneError.style.display = 'block';
            updatePhoneTick.style.display = 'none';
        } else {
            updatePhoneError.style.display = 'none';
            updatePhoneTick.style.display = 'block';
        }
    });

    updatePhone.addEventListener('keypress', function (e) {
        const updatePhoneTick = document.getElementById('update_phone_tick');
        if (!/[0-9]/.test(e.key)) {
            updatePhoneError.textContent = ' Numbers only. Letters are not allowed.';
            updatePhoneError.style.display = 'block';
            e.preventDefault();
        }
    });
}

// ===== UPDATE FORM MEMBERS VALIDATION =====
const updateMembers = document.getElementById('update_members');
const updateMembersError = document.getElementById('update_members_error');

if (updateMembers) {
    updateMembers.addEventListener('input', function () {
        if (this.value === '') {
            updateMembersError.textContent = ' This field is required.';
            updateMembersError.style.display = 'block';
        } else if (this.value <= 0) {
            updateMembersError.textContent = ' Must be a positive number greater than 0.';
            updateMembersError.style.display = 'block';
        } else {
            updateMembersError.style.display = 'none';
        }
    });
    updateMembers.addEventListener('keypress', function (e) {
        if (!/[0-9]/.test(e.key)) {
            updateMembersError.textContent = ' Numbers only. Letters are not allowed.';
            updateMembersError.style.display = 'block';
            e.preventDefault();
        }
    });
}

// ===== VOLUNTEER NIC VALIDATION =====
const volNicInput = document.getElementById('vol_nic_input');
const volNicError = document.getElementById('vol_nic_error');

if (volNicInput) {
    volNicInput.addEventListener('input', function () {
        let val = this.value;
        const tenthCharIsLetter = val.length >= 10 && /[VvXx]/.test(val[9]);
        const allDigits = /^[0-9]+$/.test(val);

        if (tenthCharIsLetter) {
            this.value = val.slice(0, 10);
            val = this.value;
        } else if (allDigits) {
            this.value = val.slice(0, 12);
            val = this.value;
        } else {
            this.value = val.replace(/[^0-9VvXx]/g, '');
            val = this.value;
        }

        const nicPattern = /^([0-9]{9}[VvXx]|[0-9]{12})$/;
        const volNicTick = document.getElementById('vol_nic_tick');

        if (val.length === 0) {
            volNicError.style.display = 'none';
            volNicTick.style.display = 'none';
        } else if (nicPattern.test(val)) {
            volNicError.style.display = 'none';
            volNicTick.style.display = 'block';
        } else {
            volNicError.textContent = 'Enter a valid NIC. (Ex: 123456789V or 200012345678)';
            volNicError.style.color = '#ff4d4d';
            volNicError.style.display = 'block';
            volNicTick.style.display = 'none';
        }
    });

    volNicInput.addEventListener('keypress', function (e) {
        const val = this.value;
        const key = e.key;
        if (/[VvXx]/.test(key)) {
            if (val.length !== 9 || !/^[0-9]{9}$/.test(val)) {
                e.preventDefault();
            }
            return;
        }
        if (!/[0-9]/.test(key)) {
            volNicError.textContent = 'Enter a valid NIC. (Ex: 123456789V or 200012345678)';
            volNicError.style.color = '#ff4d4d';
            volNicError.style.display = 'block';
            e.preventDefault();
            return;
        }
        const tenthIsLetter = val.length >= 10 && /[VvXx]/.test(val[9]);
        const maxLen = tenthIsLetter ? 10 : 12;
        if (val.length >= maxLen) {
            e.preventDefault();
        }
    });
}

// ===== VOLUNTEER PHONE VALIDATION =====
const volPhoneInput = document.getElementById('vol_phone_input');
const volPhoneError = document.getElementById('vol_phone_error');

if (volPhoneInput) {
    volPhoneInput.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);
        const volPhoneTick = document.getElementById('vol_phone_tick');
        if (this.value.length === 0) {
            volPhoneError.style.display = 'none';
            volPhoneTick.style.display = 'none';
        } else if (this.value.length < 9) {
            volPhoneError.textContent = '⚠️ Please enter exactly 9 digits.';
            volPhoneError.style.display = 'block';
            volPhoneTick.style.display = 'none';
        } else {
            volPhoneError.style.display = 'none';
            volPhoneTick.style.display = 'block';
        }
    });

    volPhoneInput.addEventListener('keypress', function (e) {
        if (!/[0-9]/.test(e.key)) {
            volPhoneError.textContent = '⚠️ Numbers only. Letters are not allowed.';
            volPhoneError.style.display = 'block';
            e.preventDefault();
        }
    });
}