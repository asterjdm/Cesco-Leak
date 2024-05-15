async function getTeachers() {
  let data = await fetch("api/getTeachers.php");
  return data.json();
}
