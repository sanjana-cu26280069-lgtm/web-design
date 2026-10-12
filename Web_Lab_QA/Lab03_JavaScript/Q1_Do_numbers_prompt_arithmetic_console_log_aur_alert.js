<script>
  let a = parseFloat(prompt("Enter first number:"));
  let b = parseFloat(prompt("Enter second number:"));
  let res = `Sum=${a + b}, Diff=${a - b}, Product=${a * b}, Quotient=${(a / b).toFixed(2)}`;
  console.log(res);
  alert(res);
</script>
