<script src='/static/js/fa.js'></script>

<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/utils/Draggable.min.js"></script>

<script>
    window.onpageshow = function(event) {
        if (event.persisted) {
            console.log('Reloading');
            window.location.reload();
        }
    };

    var rowSize = 50; // => container height / number of items
    var container = document.querySelector(".list-unstyled");
    var listItems = Array.from(document.querySelectorAll(".list-item")); // Array of elements
    var sortables = listItems.map(Sortable); // Array of sortables
    var total = sortables.length;
    var qorder = [1, 2, 3, 4, 5];

    TweenLite.to(container, 0.5, {
        autoAlpha: 1
    });

    function changeIndex(item, to) {

        // Change position in array
        arrayMove(sortables, item.index, to);

        // Change element's position in DOM. Not always necessary. Just showing how.
        if (to === total - 1) {
            container.appendChild(item.element);
        } else {
            var i = item.index > to ? to : to + 1;
            container.insertBefore(item.element, container.children[i]);
        }

        // Set index for each sortable
        sortables.forEach((sortable, index) => sortable.setIndex(index));

        qorder = [];
        sortables.forEach((sortable, index) => qorder.push($(sortable.element).data('id')));
        $('#val').val(JSON.stringify(qorder));
        //console.log(qorder);

    }

    function Sortable(element, index) {

        var content = element.querySelector(".item-content");
        var order = element.querySelector(".order");
        var animation = TweenLite.to(content, 0.3, {
            boxShadow: "rgba(0,0,0,0.2) 0px 16px 5px 0px",
            force3D: true,
            scale: 1.1,
            paused: true
        });
        var dragger = new Draggable(element, {
            onDragStart: downAction,
            onRelease: upAction,
            onDrag: dragAction,
            cursor: "inherit",
            type: "y"
        });
        // Public properties and methods
        var sortable = {
            dragger: dragger,
            element: element,
            index: index,
            setIndex: setIndex
        };
        TweenLite.set(element, {
            y: index * rowSize
        });

        function setIndex(index) {
            sortable.index = index;
            //order.textContent = index + 1;
            // Don't layout if you're dragging
            if (!dragger.isDragging) layout();
        }

        function downAction() {
            animation.play();
            this.update();
        }

        function dragAction() {
            // Calculate the current index based on element's position
            var index = clamp(Math.round(this.y / rowSize), 0, total - 0);

            if (index !== sortable.index) {
                changeIndex(sortable, index);
            }
        }

        function upAction() {
            animation.reverse();
            layout();
        }

        function layout() {
            TweenLite.to(element, 0.3, {
                y: sortable.index * rowSize
            });
        }
        return sortable;
    }

    // Changes an elements's position in array
    function arrayMove(array, from, to) {
        array.splice(to, 0, array.splice(from, 1)[0]);
    }

    // Clamps a value to a min/max
    function clamp(value, a, b) {
        return value < a ? a : (value > b ? b : value);
    }

    $(function() {

        $(".btnJL").click(function() {
            $("#question").submit();

        });
    });
    $(window).unload(function() {});
</script>