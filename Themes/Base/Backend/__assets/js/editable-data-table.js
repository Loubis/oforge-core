var $TABLE = $('[data-editable-table]');
var $BTN = $('[data-export-button]');
var $EXPORT = $('[data-export]');

$('[data-table-add]').click(function () {
    var $clone = $TABLE.find('tr.hide').clone(true).removeAttr('class');
    $TABLE.find('table').append($clone);
    $clone.find('select').select2();
});

$('[data-table-remove]').click(function () {
    $(this).parents('tr').detach();
});

$('[data-table-up]').click(function () {
    var $row = $(this).parents('tr');
    if ($row.index() === 1) return; // Don't go above the header
    $row.prev().before($row.get(0));
});

$('[data-table-down]').click(function () {
    var $row = $(this).parents('tr');
    $row.next().after($row.get(0));
});

// A few jQuery helpers for exporting only
jQuery.fn.pop = [].pop;
jQuery.fn.shift = [].shift;

$BTN.click(function () {
    var $rows = $TABLE.find('tr:not(:hidden)');
    var headers = [];
    var data = [];

    // Get the headers (add special header logic here)
    $($rows.shift()).find('th:not(:empty)').each(function () {
        headers.push($(this).text().toLowerCase());
    });

    // Turn all existing rows into a loopable array
    $rows.each(function () {
        var $tds = $(this).find('td');
        var h = {};

        // Use the headers from earlier to name our hash keys
        headers.forEach(function (header, i) {
            header = header.replace(' ', '_');
            var $td = $tds.eq(i);
            var type = $td.attr("data-type");

            if(type != null) {
                switch(type) {
                    case "text":
                        h[header] = $td.text();
                        if($td.attr("data-id") != null) {
                            h['id'] = $td.attr("data-id");
                        }
                        break;
                    case "select":
                        h[header] = $td.find("select").children("option:selected").val();
                        break;
                }
            }
        });

        data.push(h);
    });

    console.log(data);
    // Output the result
    $EXPORT.val(JSON.stringify(data));
});