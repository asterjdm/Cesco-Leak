async function getTeachers(searchQuery, sort) {
  let data = await fetch(
    `api/getTeachers.php?searchQuery=${searchQuery}&sort=${sort}`
  );
  return data.json();
}
