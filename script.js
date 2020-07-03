function update_page(id, enabled) {
    var button_map = {'Disabled' : 'Enable', 'Enabled' : 'Disable'}
    document.getElementById(`st_${id}`).innerText = enabled;
    document.getElementById(`bt_${id}`).innerText = button_map[enabled];
}

function update_entire_page(ids) {
    ids.forEach(element => {
        change_status(element);
    });
    
}

function change_status(id) {
    fetch(`/check_status.php?id=${id}`).then(function(response) {
        response.text().then(function(text) {
            update_page(id, text);
        });
    }).catch(
        function(error) {
            update_page(id, error);
        }
    );
}

function change_config(id) {
    var action = document.getElementById(`bt_${id}`).innerText;
    fetch(`/change_status.php?id=${id}&action=${action}`).then(function(response) {
        response.text().then(function(text) {
            setTimeout(function(){ change_status(id) }, 5000);
        });
    }).catch(
        function(error) {
            update_page(id, error);
        }
    );
}