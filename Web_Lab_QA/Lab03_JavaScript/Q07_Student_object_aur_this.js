<script>
  const student = {
    name: "Amit", roll: 101, marks: [80, 75, 90],
    average() { return this.marks.reduce((s, m) => s + m, 0) / this.marks.length; },
    show() { return `${this.name} (${this.roll}) average: ${this.average().toFixed(2)}`; }
  };
  console.log(student.show());
</script>
