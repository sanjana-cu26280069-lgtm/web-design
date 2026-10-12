<input type="number" id="n"> <button onclick="check()">Check</button>
<div id="out"></div>
<script>
  function check() {
    let n = parseInt(document.getElementById("n").value), prime = n > 1;
    for (let i = 2; i * i <= n; i++) if (n % i === 0) { prime = false; break; }
    document.getElementById("out").innerText = n < 2 ? n + " is neither prime nor composite" : n + (prime ? " is Prime" : " is Composite");
  }
</script>
