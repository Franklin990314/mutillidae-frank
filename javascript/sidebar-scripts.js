document.addEventListener('DOMContentLoaded', function () {
    // Se obtiene el elemento que contiene todo el sidebar
    var ul = document.getElementById('nav');

    // Se recorren los hijos de este elemento
    for (let i = 0; i < ul.children.length; i++) {

        // Se obtienen los elementos 'li' y 'ul' del sidebar
        var li = ul.children.item(i);
        var ul_1 = li.children.item(1);

        // Se valida que los hijos contengan más de un elemento y que el 'ul' sea del primer nivel del sidebar
        if (li.children.length > 1 && ul_1.id.includes('level-one')) {

            // Se realiza un evento cuando el elemento 'a' es presionado - apertura de los items
            li.children.item(0).addEventListener('click', (event) => {
                var a = undefined;
                var li = undefined;

                // Se obtiene la referencia a los elemntos 'a' y 'li'
                for (let j = 0; j < event.path.length; j++) {
                    var element = event.path[j];
                    if (element.localName == 'a') {
                        a = element;
                    } else if (element.localName == 'li') {
                        li = element;
                    }
                    if (a != undefined && li != undefined) break;
                }

                // Se modifican las clases, estilos y recursos del elemento 'a' y 'li' del primer nivel
                if (a.className == 'enabled') {
                    a.className = 'disabled';
                    a.children[1].src = './images/right.gif'
                    li.children[1].style.display = 'none';
                } else {
                    a.className = 'enabled';
                    a.children[1].src = './images/down.gif'
                    li.children[1].style.display = 'block';
                }
            });

            // Se recorren los hijos del 'ul' de primer nivel
            for (let j = 0; j < ul_1.children.length; j++) {

                // Se obtienen los elementos 'li' y 'ul' del sidebar de primer nivel
                var li_1 = ul_1.children.item(j);
                var ul_2 = li_1.children.item(1);

                // Se valida que los hijos contengan más de un elemento y que el 'ul' sea del segundo nivel del sidebar
                if (li_1.children.length > 1 && ul_2.id.includes('level-two')) {
                    
                    // Se realiza un evento cuando el elemento 'a' es presionado - apertura de los items
                    li_1.children.item(0).addEventListener('click', (event) => {
                        var a = undefined;
                        var li = undefined;

                         // Se obtiene la referencia a los elemntos 'a' y 'li'
                        for (let k = 0; k < event.path.length; k++) {
                            var element = event.path[k];
                            if (element.localName == 'a') {
                                a = element;
                            } else if (element.localName == 'li') {
                                li = element;
                            }
                            if (a != undefined && li != undefined) break;
                        }

                        // Se modifican las clases, estilos y recursos del elemento 'a' y 'li' del segundo nivel
                        if (a.className == 'enabled') {
                            a.className = 'disabled';
                            a.children[1].src = './images/right.gif'
                            li.children[1].style.display = 'none';
                        } else {
                            a.className = 'enabled';
                            a.children[1].src = './images/down.gif'
                            li.children[1].style.display = 'block';
                        }
                    });

                    // Se recorren los hijos del 'ul' de segundo nivel
                    for (let k = 0; k < ul_2.children.length; k++) {

                         // Se obtienen los elementos 'li' y 'ul' del sidebar de segundo nivel
                        var li_2 = ul_2.children.item(k);
                        var ul_3 = li_2.children.item(1);

                        // Se valida que los hijos contengan más de un elemento y que el 'ul' sea del tercer nivel del sidebar
                        if (li_2.children.length > 1 && ul_3.id.includes('level-three')) {
                            
                            // Se realiza un evento cuando el elemento 'a' es presionado - apertura de los items
                            li_2.children.item(0).addEventListener('click', (event) => {
                                var a = undefined;
                                var li = undefined;

                                // Se obtiene la referencia a los elemntos 'a' y 'li'
                                for (let m = 0; m < event.path.length; m++) {
                                    var element = event.path[m];
                                    if (element.localName == 'a') {
                                        a = element;
                                    } else if (element.localName == 'li') {
                                        li = element;
                                    }
                                    if (a != undefined && li != undefined) break;
                                }

                                // Se modifican las clases, estilos y recursos del elemento 'a' y 'li' del tercer nivel
                                if (a.className == 'enabled') {
                                    a.className = 'disabled';
                                    a.children[1].src = './images/right.gif'
                                    li.children[1].style.display = 'none';
                                } else {
                                    a.className = 'enabled';
                                    a.children[1].src = './images/down.gif'
                                    li.children[1].style.display = 'block';
                                }
                            });
                        }
                    }
                }
            }
        }
    }
});