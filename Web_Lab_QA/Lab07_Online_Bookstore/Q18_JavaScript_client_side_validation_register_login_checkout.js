function bad(msg) { alert(msg); return false; }
document.addEventListener("DOMContentLoaded", () => {
  const reg = document.getElementById("regForm");
  if (reg) reg.onsubmit = () => {
    if (reg.name.value.trim().length < 2) return bad("Enter a valid name");
    if (!/^[^@\s]+@[^@\s]+\.[a-z]{2,}$/i.test(reg.email.value)) return bad("Enter a valid email");
    if (reg.password.value.length < 6) return bad("Password must be at least 6 characters");
  };
  const login = document.getElementById("loginForm");
  if (login) login.onsubmit = () => {
    if (!login.email.value || !login.password.value) return bad("Email and password required");
  };
  const co = document.getElementById("checkoutForm");
  if (co) co.onsubmit = () => {
    if (!co.name.value.trim() || !co.address.value.trim() || !co.city.value.trim()) return bad("Fill all shipping details");
    if (!/^[0-9]{6}$/.test(co.pin.value)) return bad("PIN code must be 6 digits");
  };
});
