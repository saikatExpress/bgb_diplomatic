$(document).ready(function () {
    $("#printMainTableBtn").on("click", function (e) {
        e.preventDefault();

        const $tableClone = $("#main_letter_table_print").clone();

        const actionColIndex = $tableClone
            .find("thead th")
            .filter(function () {
                return $(this).hasClass("remarks");
            })
            .index();

        $tableClone.find("thead th").eq(actionColIndex).remove();

        // Remove corresponding "Action" cells in each row
        $tableClone.find("tbody tr").each(function () {
            $(this).find("td").eq(actionColIndex).remove();
        });

        // Open a new print window
        const printWindow = window.open("", "", "height=900,width=1200");
        printWindow.document.write("<html><head><title>Print Table</title>");
        printWindow.document.write(
            "<style>table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #000; padding: 8px; }</style>"
        );
        printWindow.document.write("</head><body>");
        printWindow.document.write("<h3>Main Letter</h3>");
        printWindow.document.write($tableClone.prop("outerHTML"));
        printWindow.document.write("</body></html>");
        printWindow.document.close();
        printWindow.focus();

        // Print
        printWindow.print();

        printWindow.close();
    });

    $("#printRefTableBtn").on("click", function (e) {
        e.preventDefault();

        const $tableClone = $("#ref_letter_table_print").clone();

        const actionColIndex = $tableClone
            .find("thead th")
            .filter(function () {
                return $(this).hasClass("remarks");
            })
            .index();

        $tableClone.find("thead th").eq(actionColIndex).remove();

        // Remove corresponding "Action" cells in each row
        $tableClone.find("tbody tr").each(function () {
            $(this).find("td").eq(actionColIndex).remove();
        });

        // Open a new print window
        const printWindow = window.open("", "", "height=900,width=1200");
        printWindow.document.write("<html><head><title>Print Table</title>");
        printWindow.document.write(
            "<style>table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #000; padding: 8px; }</style>"
        );
        printWindow.document.write("</head><body>");
        printWindow.document.write("<h3>Reference Letter</h3>");
        printWindow.document.write($tableClone.prop("outerHTML"));
        printWindow.document.write("</body></html>");
        printWindow.document.close();
        printWindow.focus();

        // Print
        printWindow.print();

        printWindow.close();
    });

    $("#printReplyTableBtn").on("click", function (e) {
        e.preventDefault();

        const $tableClone = $("#reply_file_table_print").clone();

        const actionColIndex = $tableClone
            .find("thead th")
            .filter(function () {
                return $(this).hasClass("remarks");
            })
            .index();

        $tableClone.find("thead th").eq(actionColIndex).remove();

        // Remove corresponding "Action" cells in each row
        $tableClone.find("tbody tr").each(function () {
            $(this).find("td").eq(actionColIndex).remove();
        });

        // Open a new print window
        const printWindow = window.open("", "", "height=900,width=1200");
        printWindow.document.write("<html><head><title>Print Table</title>");
        printWindow.document.write(
            "<style>table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #000; padding: 8px; }</style>"
        );
        printWindow.document.write("</head><body>");
        printWindow.document.write("<h3>Reply Letter</h3>");
        printWindow.document.write($tableClone.prop("outerHTML"));
        printWindow.document.write("</body></html>");
        printWindow.document.close();
        printWindow.focus();

        // Print
        printWindow.print();

        printWindow.close();
    });
});
