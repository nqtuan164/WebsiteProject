//Starting a drag

var dragSrcEl = null;

function handleDragStart(e) {
    // this / e.target is the source node
    this.style.opacity = '0.6';
    
    dragSrcEl = this;
    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/html', this.innerHTML);
}

function handleDragOver(e) {
    if (e.preventDefault) {
        e.preventDefault();
    }
    e.dataTransfer.dropEffect = 'move';
    this.classList.add('over');
    return false;
}

function handleDragEnter(e) {
    this.classList.add('over');
}

function handleDragLeave(e) {
    this.classList.remove('over');
}

function handleDrop(e) {
    if (e.stopPropagation) {
        e.stopPropagation();
    }

    if (dragSrcEl != this) {
        dragSrcEl.innerHTML = this.innerHTML;
        this.innerHTML = e.dataTransfer.getData('text/html');
        //Set default state of moved div
        dragSrcEl.style.opacity = "1";
        this.classList.remove('over');
    }

    return false;
}

function handleDragEnd(e) {
    var cols = document.querySelectorAll("#columns .column");

    [].forEach.call(cols, function (col) {
        col.classList.remove('over');
        col.style.opacity = '1';
    });
}



$("document").ready(function () {
    var cols = document.querySelectorAll("#columns .column");
    
    [].forEach.call(cols, function (col) {
        col.addEventListener('dragstart', handleDragStart, false);
        col.addEventListener('dragenter', handleDragEnter, false);
        col.addEventListener('dragover', handleDragOver, false);
        col.addEventListener('dragleave', handleDragLeave, false);

        col.addEventListener('drop', handleDrop, false);
        col.addEventListener('dragend', handleDragEnd, false);
    });
    
});








