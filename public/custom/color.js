//color master module

//load Color
var colors = [];
var family = [];
$(document).ready(() => {
    try {
        $.ajax({
            url: '/admin/onload_shade/',
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                colors = data[0];
                family = data[1];
                loadShadeFamily(family);
                loadShadeColor(colors)
            }
        });
    }
    catch (ex) {

    }
});

//load Shade Family 
loadShadeFamily = family => {
    const sahdeFamily = family.map(data => {
        return '<li class="list-group-item d-flex justify-content-between align-items-center">' +
            '<a href = "javascript:void(null)" onClick="filterShadeFamily(' + data.id + ')" style="color:' + data.shade_family_code + '"> ' + data.shade_family_name + '</a >' +
            '<div>' +
            '<span class="badge badge-primary badge-pill" onclick="editShadeFamily(' + data.id + ')"><i class="ft-edit"></i></span>' +
            '<span class="badge badge-primary badge-pill" onclick="deleteFamily(' + data.id + ')"><i class="ft-trash-2"></i></span>' +
            '</div></li > ';
    });
    const colorShadeFamilyValue = family.map(val => {
        return '<option value="' + val.id + '">' + val.shade_family_name + '</option>'
    })
    $('#shade_family_id').html(colorShadeFamilyValue);
    $('#loadFamily').html(sahdeFamily);
}

//load Colors
loadShadeColor = colors => {
    const getColors = colors.map(data => {
        return '<div class="card mb-1 col-md-3"><div class="card-content">' +
            '<div class="bg-lighten-1 height-50" style="background-color:' + data.shade_code + '">' +
            '<span style="color: #fff;font-size: 16px;font-weight: 600;margin: 10px;"></span></div>' +
            '<div class="p-1"><p class="mb-0"><strong>' + data.shade_name + '</strong>' +
            '<div class="text-muted float-right">' +
            '<div class="btn-group" role="group" aria-label="Third Group">' +
            '<button type="button" class="btn btn-icon btn-outline-warning" onclick="editShadeColor(' + data.id + ')"><i class="ft ft-edit"></i></button>' +
            '<button type="button" class="btn btn-icon btn-outline-danger" onclick="deleteColor(' + data.id + ')"><i class="la la-trash"></i></button>' +
            '</div></div></p><p class="mb-0">' + data.code_name + '</p></div>' +
            '</div></div>';
    });

    $('#colorCounter').html(`<p>There Are ${colors.length} colors</p>`);
    $('#loadColors').html(getColors);
}

//filter Shade Family Color
filterShadeFamily = id => {
    const getShadeFamily = colors.filter(color => color.shade_family_id == id)
    if (!getShadeFamily.length > 0) {
        $('#colorCounter').html('');
        $('#loadColors').html('<p class="text-center">There are No Colors</p>');
        return;
    }
    loadShadeColor(getShadeFamily);
}

//reload All Colors
reloadAllcolor = () => {
    loadShadeColor(colors);
}

$('#searchHandle').keyup(() => {
    let keyValue = $('#searchHandle').val()
    if (keyValue.length > 3) {
        let searchResult = colors.filter(data => data.code_name.toLowerCase().startsWith(keyValue.toLowerCase()));
        if (!searchResult.length > 0) {
            $('#loadColors').html('<p class="text-center">There are No Colors</p>');
            return;
        }
        loadShadeColor(searchResult);
    } else if (keyValue.length === 0) {
        loadShadeColor(colors);
    }
});

//shade family edit
editShadeFamily = id => {
    $('#shade_family').modal('show');
    $('#shadeFamilyLabel').text('Edit Shade Family');
    const eFamily = family.filter(data => data.id == id);
    $('input[name=shade_family_name]').val(eFamily[0].shade_family_name);
    $('input[name=shade_family_code]').val(eFamily[0].shade_family_code);
    $('input[name=family_id]').val(id);
}


//save Shade Family
$('#saveShadeFamily').click(() => {
    var formData = new FormData($('#shade_family_form')[0]);
    $.ajax({
        url: '/admin/save-shade-family',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            if ($('input[name=family_id]').val()) {
                // family[index].shade_family_name = data.shade_family_name;
                // family[index].shade_family_code = data.shade_family_code
                family = family.map(f => {
                    if (f.id == data.id) {
                        f.shade_family_name = data.shade_family_name;
                        f.shade_family_code = data.shade_family_code;
                    }
                    return f
                })
                toastr.success('Shade Family', 'Successfully Update');
            } else {

                family.push(data)
                toastr.success('Shade Family', 'Successfully Save');

            }
            $('#shade_family').modal('hide');
            loadShadeFamily(family)
            $("#shade_family_form")[0].reset();

        }, error: function (data) {
            toastr.error('Fill All Fields', 'Required!');
        }
    });
})


$('#saveShadeColor').click(() => {
    var formData = new FormData($('#shade_color_form')[0]);
    $.ajax({
        url: '/admin/save-shade-color',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            if ($('input[name=color_id]').val()) {
                colors = colors.map(c => {
                    if (c.id == data.id) {
                        c.shade_name = data.shade_name;
                        c.shade_code = data.shade_code;
                        c.code_name = data.code_name;
                        c.shade_family_id = data.shade_family_id;
                    }
                    return c
                })
                toastr.success('Shade Color', 'Successfully Update');
            } else {

                colors.push(data)
                toastr.success('Shade Color', 'Successfully Save');

            }
            $('#color_model').modal('hide');
            loadShadeColor(colors)
            $("#shade_color_form")[0].reset();

        }, error: function (data) {
            toastr.error('Fill All Fields', 'Required!');
        }
    });
})



deleteFamily = id => {
    var r = confirm("Are you sure");
    if (r == true) {
        $.ajax({
            url: '/admin/delete_shade_family/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                toastr.success('Shade Family', 'Successfully Delete');
                loadShadeFamily(family = family.filter(f => f.id != id))
            }
        });
    }

}

//new shade family form
$('#new_shade_family').click(() => {
    $('#shade_family').modal('show');
    $('#shadeFamilyLabel').text('New Shade Family');
    $('input[name=family_id]').val('');
    $("#shade_family_form")[0].reset();
})
//new shade color
$('#new_color_shade').click(() => {
    $('#color_model').modal('show');
    $('#shadeFamilyLabel').text('New Shade color');
    $('input[name=color_id]').val('');
    $("#shade_color_form")[0].reset();
})

editShadeColor = id => {
    $('#color_model').modal('show');
    $('#shadeFamilyLabel').text('Edit Shade color');
    const color = colors.filter(data => data.id == id);
    $('input[name=shade_name]').val(color[0].shade_name);
    $('input[name=shade_code]').val(color[0].shade_code);
    $('input[name=code_name]').val(color[0].code_name);
    $('select[name=shade_family_id]').val(color[0].shade_family_id);
    $('input[name=color_id]').val(id);
}

//Delete Color
deleteColor = id => {
    var r = confirm("Are you sure");
    if (r == true) {
        $.ajax({
            url: '/admin/delete_shade_color/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                console.log(id)
                console.log(data)
                toastr.success('Shade colors', 'Successfully Delete');
                loadShadeColor(colors = colors.filter(f => f.id != id))
            }
        });
    }
}





handleEdit = id => {
    $.ajax({
        url: '/admin/edit_color_category/' + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#saveCat').text('Save Change');
            $('input[name=family_name]').val(data.family_name);
            $('input[name=family_color]').val(data.family_color);
            $('input[name=family_id]').val(id);
            $('#shadeFamilyLabel').text('Edit Shade Family')
            $('#shade_family').modal('show');
            action_type = 2;
        }
    });
}


$('#color-bank-bulk-button').on('click', () => {
    var formData = new FormData($('#color_bulk_data')[0]);
    try {
        $.blockUI({
            message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
            timeout: 20000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#FFF',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                color: '#333',
                backgroundColor: 'transparent'
            },
        });
        $.ajax({
            url: '/admin/color-bulk-data',
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                $.unblockUI();
                console.log(data);
                toastr.success('Color Bank', 'Successfully Save');
            }, error: function (data, errorThrown) {
                var errorData = data.responseJSON.errors;
                $.each(errorData, function (i, obj) {
                    toastr.error(obj[0]);
                });
            }
        });
    } catch (err) {
        toastr.error("Please Paste Color Json Data");
    }
});
var feature = [];
var fc = 1;
$('#addFeature').on('click', () => {
    let output = '<div class="form-group row" id="featurerow' + fc + '"><div class="col-11" >' +
        '<input type="text" class="form-control" name="features[]" placeholder="Product Feature"></div>' +
        '<div class="col-1"><i class="ft-minus-circle text-danger remove_btn" onclick="removeFeature(' + fc + ')"></i></div>' +
        '</div></div>';
    fc++;
    feature.push(fc);
    $('#featurePlace').append(output);
})
function removeFeature(id) {
    if (confirm('Are you sure delete this?')) {
        feature = jQuery.grep(feature, function (value) {
            return value != id;
        });
        console.log(feature)
        $("#featurerow" + id).remove();
    }
}
$('#color_product_save').on('click', () => {
    var formData = new FormData($('#product_form_data')[0]);
    var product_description = tinyMCE.activeEditor.getContent();
    formData.append('product_description', product_description);
    $.ajax({
        url: '/admin/color-product-save',
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {

            console.log(data);
            toastr.success('Color Product', 'Successfully ' + data);
            window.location.href = "/admin/color-products";
        }, error: function (data, errorThrown) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function (i, obj) {
                toastr.error(obj[0]);
            });
        }
    });
})

function removeEditFeature(id) {
    if (confirm('Are you sure delete this?')) {
        $.ajax({
            url: '/admin/delete-product-feature',
            method: "GET",
            data: { id },
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                $('#featureEditRow' + id).remove();
            }
        })
    }
}
var litANDpriceData = [];
var lApC = 1;
$('#addLitPriceBox').on('click', function () {
    let tableValue = '<div class="row" id="litPriceBox' + lApC + '">' +
        '<div class="col-md-3" > <div class="form-group">' +
        '<label class="label-control" for="projectinput1">Discount / High</label>' +
        '<select name="price_type[]" class="form-control">' +
        '<option value="" selected="" disabled="">Select </option>' +
        '<option value="discount">Discount </option>' +
        '<option value="high">High </option></select></div></div>' +
        '<div class="col-md-3" > <div class="form-group">' +
        '<label class="label-control" for="projectinput1">Litreage</label>' +
        '<select name="paint_lit[]" class="form-control">' +
        '<option value="" selected="" disabled="">Select </option>' +
        '<option value="500">500 Lit </option>' +
        '<option value="1">1 Lit </option>' +
        '<option value="4">4 Lit </option>' +
        '<option value="20">20 Lit </option>' +
        '<option value="10">10 Lit </option>' +
        '</select></div></div > ' +
        '<div class="col-md-2" > <div class="form-group">' +
        '<label class="label-control" for="projectinput1">Type</label>' +
        '<select name="value_type[]" class="form-control">' +
        '<option value="" selected="" disabled="">Select </option>' +
        '<option value="percentage">Percentage </option>' +
        '<option value="amount">Amount </option>' +
        '</select></div></div > ' +
        '<div class="col-md-2" > <div class="form-group">' +
        '<label class="label-control" for="projectinput1">Value</label> ' +
        '<input type="text" name="amount[]" class="form-control" placeholder="Enter Value"></div></div>' +
        '<div class="col-md-2" > <div class="form-group">' +
        '<label class="label-control" for="projectinput1">Price</label> <i class="ft-minus-circle text-danger remove_btn" onclick="removeLitAndPrice(' + lApC + ')" style="float:right"></i>' +
        '<input type="text" name="price[]" class="form-control" placeholder="Enter Non Color Price"></div></div>' +
        '</div>';
    litANDpriceData.push(lApC);
    $('#litandpricePlace').append(tableValue);
    lApC++;
});

function removeLitAndPrice(id) {
    if (confirm('Are you sure delete this?')) {
        litANDpriceData = jQuery.grep(litANDpriceData, function (value) {
            return value != id;
        });
        $("#litPriceBox" + id).remove();
    }

}

function removeLitAndPriceEdit(id) {
    if (confirm('Are you sure delete this?')) {
        $.ajax({
            url: '/admin/delete-product-paint_lit/' + id,
            method: "GET",
            dataType: "JSON",
            success: function (data) {
                $("#litPriceBoxEdit" + id).remove();
            }
        })
    }
}

function paint_lit_change(classes, id) {
    // var fields;
    var getDatas = $('#' + classes + id).val();
    $.ajax({
        url: '/admin/change-paint-lit',
        method: "GET",
        data: { id: id, fields: classes, data: getDatas },
        dataType: "JSON",
        success: function (data) {
            //console.log(data);
            toastr.success(data.message);
        }
    })

}

function applyRegular(id) {
    var prices = $('#regular_price' + id).val();
    $('.regular_price').each(function () {
        $('.regular_price').val(prices)
    })
}
function applySales(id) {
    var prices = $('#sales_price' + id).val();
    $('.sales_price').each(function () {
        $('.sales_price').val(prices)
    })
}