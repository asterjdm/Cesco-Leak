async function getTeachers(searchQuery) {
  let data = await fetch(`api/getTeachers.php?searchQuery=${searchQuery}`);
  return data.json();
}
