import axios from 'axios';


document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('#tasks_tbl tbody tr');

    rows.forEach(function (row) {
        row.addEventListener('dragstart', handleDragStart);
        row.addEventListener('dragover', handleDragOver);
        row.addEventListener('drop', handleDrop);
    });
});

function handleDragStart(event) {
    event.dataTransfer.effectAllowed = 'move';
    event.dataTransfer.setData('text/plain', event.target.dataset.taskId);
}

function handleDragOver(event) {
    event.preventDefault();
    event.dataTransfer.dropEffect = 'move';
}

function handleDrop(event) {
    event.preventDefault();

    const sourceTaskId = event.dataTransfer.getData('text/plain');
    const targetTaskId = event.currentTarget.dataset.taskId;

    console.log("Moved " +sourceTaskId + " to " + targetTaskId );
        
    axios.post('/tasks/change-priorities', {
            sourceId: sourceTaskId,
            targetId: targetTaskId
        })
        .then(response => {
            window.location.reload();
        })
        .catch(error => {
            console.log(error)
            alert(error)
        });
    
}
