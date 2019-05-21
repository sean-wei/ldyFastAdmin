define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'ldy_picture/index' + location.search,
                    add_url: 'ldy_picture/add',
                    edit_url: 'ldy_picture/edit',
                    del_url: 'ldy_picture/del',
                    multi_url: 'ldy_picture/multi',
                    table: 'ldy_picture',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'name', title: __('Name')},
                        {field: 'picture', title: __('Picture'), formatter:Table.api.formatter.images, operate:false},
                        {field: 'tpl', title: __('Tpl')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'uploadtime', title: __('Uploadtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            // 给上传按钮添加上传成功事件
            $("#plupload-ldy-picture").data("upload-success", function (data) {
                alert('upload photo');
                var url = Backend.api.cdnurl(data.url);
                $(".profile-server-img").prop("src", url);
                Toastr.success("上传成功！");

            });
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});