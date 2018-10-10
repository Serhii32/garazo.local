$.fn.extend({
    treed: function (o) {
      
        var openedClass = 'fa-minus';
        var closedClass = 'fa-plus';
      
        if (typeof o != 'undefined'){
            if (typeof o.openedClass != 'undefined'){
            openedClass = o.openedClass;
            }
            if (typeof o.closedClass != 'undefined'){
            closedClass = o.closedClass;
            }
        };
      
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this);
            branch.prepend("<i class='indicator fa " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });

        tree.find('.branch .indicator').each(function(){
            console.log($(this));
            $(this).on('click', function () {
                $(this).closest('li').click();
            });
        });
    }
});

//Initialization of treeviews

$('#tree1').treed();