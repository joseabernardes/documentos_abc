
/*
 * --------------------------------------- CHECKS --------------------------------------
 */

function checkLocalStorageSupport() {
    var check = 'check';
    try {
        localStorage.setItem(check, check);
        localStorage.removeItem(check);
        return true;
    } catch (e) {
        return false;
    }
}


/*
 * ---------------------------------- ARRAYS & STORAGE ---------------------------------
 */

var notes = [];

var noteNumber = 0;

var doc = '';

var firstTime = true;


function loadNotesLocalStorage() {
    try {
        if (localStorage.getItem(doc)) {
            notes = JSON.parse(localStorage.getItem(doc));

            for (var i = 0; i < notes.length; ++i) {

                if (notes[i].note.length > 0) {
                    notes[i].id = ++noteNumber;
                    addNoteDOM(notes[i].id, notes[i].note, true);
                } else {
                    notes.splice(i, 1); //remover notas que foram guardadas vazias!
                    i--;
                }

            }
            saveNotesLocalStorage();
        }
    } catch (e) {

    }

}



function saveNotesLocalStorage() {
    try {
        var jsonNotes = JSON.stringify(notes);
        localStorage.setItem(doc, jsonNotes);
//        localStorage.notes = jsonNotes;
        return true;
    } catch (err) {
        alert('ups!');
        return false;
    }
}

function containsID(id, array) {
    for (var i = 0; i < array.length; i++) {
        if (array[i].id == id) {
            return i;
        }
    }
    return false;
}


function saveNote(obj) {
    var i = containsID(obj.id, notes);
    if (i !== false) {
        notes[i].note = obj.note;
    } else {
        notes.push(obj);
    }

    return saveNotesLocalStorage();
}

function deleteNote(id) {
    var i = containsID(id, notes);
    if (i !== false) {
        notes.splice(i, 1);
        return saveNotesLocalStorage();
    } else {
        return false;
    }
}

/*
 * --------------------------------- DOM ACCESS/CREATE ---------------------------------
 */
function expandDOM(element) {
    element.css('height', 'auto');
    element.css('height', element[0].scrollHeight + 'px');
}


function addNoteDOM(id, content, load) {
    window.console.log(id);
    var div = $("<div>", {class: 'note', id: id});
    var textArea = $('<textarea>', {rows: '3'});
    textArea.html(content).keydown(expandEVH);
    var deleteImg = $('<img />', {id: 'delete', src: '../images/delete.png', title: 'Eliminar', alt: 'D'});
    if (load) {
        var saveImg = $('<img />', {id: 'save', src: '../images/save.png', title: 'Guardar', alt: 'D'});
    } else {
        var saveImg = $('<img />', {id: 'save', src: '../images/save-red.png', title: 'Guardar', alt: 'D'});
    }
    deleteImg.click(deleteEVH);
    saveImg.click(saveEVH);
    div.append(deleteImg).append(saveImg).append(textArea);
    div.hide();
    $('div#notes  > input#add').before(div);
    div.show('fast');
    expandDOM(textArea);
}

function deleteNoteDOM(id) {
    $('div#' + id).hide('fast', function () {
        $('div#' + id).remove();

    });

}


function getNoteDOM(element) {

    return element.siblings('textarea').val().trim();
}

function showNotesDOM() {
    var div = $('div#notes');
    if (firstTime) {
        div.show('fast', function () {
            firstTime = false;
            loadNotesLocalStorage();

        });
    } else {

        if (div.is(':hidden')) {
            div.show('fast');
        } else {
            div.hide('fast');
        }
    }


}




function saveButtonShadow(element, saved) {
    if (saved) {
        element.attr('src', '../images/save.png');
    } else {
        element.attr('src', '../images/save-red.png');
    }
}

/*
 * --------------------------------- Event Handlers ---------------------------------
 */

function addNoteEVH() {

    addNoteDOM(++noteNumber, '', false);

}

function deleteEVH(event) {
    var element = $(event.target);
    var id = element.parent().attr('id');
    if (deleteNote(id)) {
        deleteNoteDOM(id);
    }


}

function saveEVH(event) {
    var element = $(event.target);
    var note = getNoteDOM(element);
    var id = element.parent().attr('id');
    var obj = {id: id, note: note};
    saveButtonShadow(element, saveNote(obj)); //alterar o icon para normal

//    localStorage.setItem($("#docid").val(), JSON.stringify(obj));


}

function expandEVH(event) {
    var element = $(event.target);
    expandDOM(element);
    saveButtonShadow(element.siblings('img#save'), false);
}


$(document).ready(function () {

    if (checkLocalStorageSupport) {

        doc = 'doc_' + $("body").attr('id');
        $("div#notes > div.note >textarea").keydown(expandEVH);
        $("div#notes > input#add").click(addNoteEVH);
        $('input#show').click(showNotesDOM);
//        $("div#notes > div.note > img#delete").click(deleteEVH);
//        $("div#notes > div.note > img#save").click(saveEVH);
    }

});




