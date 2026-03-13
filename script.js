function confirmAction(message) {
    return confirm(message);
}

function showSuccess(message) {
    alert(message);
}

window.addEventListener('scroll', function() {
  const nav = document.querySelector('.navbar');
  if (window.scrollY > 50) {
    nav.classList.add('scrolled');
  } else {
    nav.classList.remove('scrolled');
  }
});
function fetchDivisions(districtName) {
    var dsSelect = document.getElementById("ds_select");
    
    if (districtName === "") {
        dsSelect.innerHTML = '<option value="">Select District First</option>';
        return;
    }
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "get_divisions.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            dsSelect.innerHTML = xhr.responseText;
        }
    };
    xhr.send("district=" + districtName);
}

const phoneInput = document.getElementById('phone_input');
const phoneError = document.getElementById('phone_error');

if (phoneInput) {
    phoneInput.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);
        if (this.value.length > 0 && this.value.length < 9) {
            phoneError.textContent = 'Please enter exactly 9 digits.';
            phoneError.style.display = 'block';
        } else {
            phoneError.style.display = 'none';
        }
    });

    phoneInput.addEventListener('keypress', function (e) {
        if (!/[0-9]/.test(e.key)) {
            phoneError.textContent = 'Numbers only. Letters are not allowed.';
            phoneError.style.display = 'block';
            e.preventDefault();
        }
    });
}

const membersInput = document.getElementById('members_input');
const membersError = document.getElementById('members_error');

if (membersInput) {
    membersInput.addEventListener('input', function () {
        if (this.value <= 0 || this.value === '') {
            membersError.textContent = 'Must be a positive number (greater than 0).';
            membersError.style.display = 'block';
        } else {
            membersError.style.display = 'none';
        }
    });

    membersInput.addEventListener('keypress', function (e) {
        if (!/[0-9]/.test(e.key)) {
            membersError.textContent = 'Numbers only. Letters are not allowed.';
            membersError.style.display = 'block';
            e.preventDefault();
        }
    });
}


