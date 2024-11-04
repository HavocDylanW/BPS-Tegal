import { DataTable } from "simple-datatables";

document.addEventListener("DOMContentLoaded", function () {
    const tableElement = document.getElementById("pagination-table");

    if (tableElement) {
        const dataTable = new DataTable(tableElement, {
            paging: true,
            perPage: 5,
            perPageSelect: [5, 10, 15, 20, 25],
            sortable: true, // Set to true if you want sorting enabled
        });
    }
});
