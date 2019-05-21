define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'ldy_doc_reply/index' + location.search,
                    add_url: 'ldy_doc_reply/add',
                    edit_url: 'ldy_doc_reply/edit',
                    del_url: 'ldy_doc_reply/del',
                    multi_url: 'ldy_doc_reply/multi',
                    table: 'ldy_doc_reply',
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
                        // {field: 'id', title: __('Id')},
                        {field: 'doc_id', title: __('Doc_id')},
                        // {field: 'level', title: __('Level')},
                        {field: 'a_nickname', title: __('A_nickname')},
                        {field: 'photo', title: __('Photo'), formatter:Table.api.formatter.images,events: Table.api.events.img},
                        {field: 'q_nickname', title: __('Q_nickname')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
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