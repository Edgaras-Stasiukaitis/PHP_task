function showConfirmDialog(module, removeId, search = null, order = null, from = null, to = null, pageId = null, totalPages = null, totalRecords = null, countryId = null) {
    var r = confirm("Ar tikrai norite pašalinti?");
	if(totalPages == pageId && totalRecords % 10 == 1){
		pageId--;
	}
    if (r === true && countryId === null) {
        window.location.replace("index.php?module=" + module + "&action=delete&id=" + removeId + "&search=" + search + "&order=" + order + "&from=" + from + "&to=" + to + "&page=" + pageId);
    }
	if (r === true && countryId !== null) {
        window.location.replace("index.php?module=" + module + "&action=delete&id=" + removeId + "&countryID=" + countryId + "&search=" + search + "&order=" + order + "&from=" + from + "&to=" + to + "&page=" + pageId);
    }
}