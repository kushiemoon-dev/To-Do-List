const tasksList = {
    init: function() {
        tasksList.loadTasksAPI();
    },

    loadTasksAPI: async function() {
        
        const response = await fetch('http://localhost:8000/api/tasks');

       
        if (response.status === 200) {
            
            const tasksListAPI = await response.json();
            

            
            tasksList.emptyTasksContainer();

            
            for (const task of tasksListAPI) {
                
                tasksList.insertTaskIntoDOM(task);
            }
        }
    },

    insertTaskIntoDOM: function(taskData) {
       

        

        const newTaskElement = document.createElement('li');
        
        newTaskElement.dataset.id = taskData.id;

        const titleElement = document.createElement('p');
        titleElement.textContent = taskData.title;

        const deleteElement = document.createElement('div');
        deleteElement.classList.add('delete');

        const editElement = document.createElement('div');
        editElement.classList.add('edit');

        
        newTaskElement.append(titleElement, deleteElement, editElement);

        
        const tasksContainer = document.querySelector('.tasklist');
        tasksContainer.append(newTaskElement);

    },

    emptyTasksContainer: function() {
        const tasksContainer = document.querySelector('.tasklist');
        
        tasksContainer.replaceChildren();
    }
};