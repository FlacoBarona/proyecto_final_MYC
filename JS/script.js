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