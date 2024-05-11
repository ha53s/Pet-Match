let btn = document.querySelector('#btn');
    let sidebar = document.querySelector('.sidebar');
    
    btn.onclick = function(){
        sidebar.classList.toggle('active');
    };
    
    
        let content = document.getElementById('content');

        
        let links = document.querySelectorAll('.sidebar a');

       
        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault(); 

                
                links.forEach(function(item) {
                    item.classList.remove('active');
                });

               
                link.classList.add('active');

                
                let targetPage = link.getAttribute('data-page');

                
                fetch(targetPage)
                    .then(response => response.text())
                    .then(data => {
                        content.innerHTML = data;
                    })
                    .catch(error => console.error('Error fetching content:', error));
            });
        });
    
    
    document.getElementById('logout').addEventListener('click', function(e) {
        e.preventDefault(); 

        fetch('logoutadmin.php')
            .then(response => {
                window.location.href = 'logadmin.php';
            })
            .catch(error => console.error('Error logging out:', error));
    });