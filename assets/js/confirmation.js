function delete_id(id) {
    if(confirm('Weet je zeker dat je het huidige moment wil overschrijven?'))
    {
    window.location.href='index.php?delete_id='+id;
    }
}