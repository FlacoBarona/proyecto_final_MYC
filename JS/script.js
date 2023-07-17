
function showFilteredGames(games) {
    var gameList = document.getElementById('game-list');
    gameList.innerHTML = '';
  
    var gameContainer = document.createElement('div');
    gameContainer.className = 'row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3';
  
    games.forEach(function(game) {
      var colDiv = document.createElement('div');
      colDiv.className = 'col';
  
      var cardDiv = document.createElement('div');
      cardDiv.className = 'card shadow-sm';
  
      var image = document.createElement('img');
      var id = game.id;
      var imagen = "Images/juegos/" + id + "/principal.jpeg";
      if (!fileExists(imagen)) {
        imagen = "images/no-photo.jpg";
      }
      image.src = imagen;
  
      var cardBodyDiv = document.createElement('div');
      cardBodyDiv.className = 'card-body';
  
      var title = document.createElement('h5');
      title.className = 'card-title';
      title.textContent = game.nombre;

      var divmed = document.createElement('div');
      divmed.className = 'd-flex justify-content-between align-items-center';

      var plataforma = document.createElement('p');
      plataforma.className = 'card-text';
      plataforma.textContent = game.plataforma;
  
      var price = document.createElement('p');
      price.className = 'card-text';
      price.textContent = game.precio + ' $';

      var jugabilidad = document.createElement('p');
      jugabilidad.className = 'card-text';
      jugabilidad.textContent = game.jugabilidad;
  
      var buttonDiv = document.createElement('div');
      buttonDiv.className = 'd-flex justify-content-between align-items-center';
  
      var btnGroupDiv = document.createElement('div');
      btnGroupDiv.className = 'btn-group';
  
      var detailsLink = document.createElement('a');
      detailsLink.href = 'detalles.php?id=' + game.id + "&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>";
      detailsLink.className = 'btn btn-primary';
      detailsLink.textContent = 'Detalles';
  
      var addToCartButton = document.createElement('button');
      addToCartButton.className = 'btn btn-outline-success';
      addToCartButton.type = 'button';
      addToCartButton.setAttribute('onclick', 'addProducto(' + game.id + ', "<?php echo hash_hmac(\'sha1\', $row[\'id\'], KEY_TOKEN); ?>")');
      addToCartButton.textContent = 'Agregar al carrito';
  
      btnGroupDiv.appendChild(detailsLink);
      buttonDiv.appendChild(btnGroupDiv);
      buttonDiv.appendChild(addToCartButton);
      divmed.appendChild(plataforma);
      divmed.appendChild(price);
      cardBodyDiv.appendChild(title);
      cardBodyDiv.appendChild(buttonDiv);
      cardBodyDiv.appendChild(divmed);
      cardBodyDiv.appendChild(jugabilidad);
      cardDiv.appendChild(image);
      cardDiv.appendChild(cardBodyDiv);
      colDiv.appendChild(cardDiv);
      gameContainer.appendChild(colDiv);
    });
  
    gameList.appendChild(gameContainer);
  }


function searchGames() {
    var input = searchInput.value.toLowerCase();
    var gameList = document.getElementById('game-list');
    //gameList.innerHTML = '';
    
    // Realizar la llamada AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'buscar_juegos.php?search=' + encodeURIComponent(input), true);
  
    xhr.onload = function() {
        if (xhr.status === 200) {
          var games = JSON.parse(xhr.responseText);
          showFilteredGames(games);
        } else {
          console.log('Error: ' + xhr.status);
        }
      };
  
  
    xhr.send();
  }

  function fileExists(url) {
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status !== 404;
  }