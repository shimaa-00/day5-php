    <script>
        const error = Array.from(document.getElementsByClassName('error'));
        const toggleSubmenu = document.getElementById('toggle-menu');


        toggleSubmenu.onclick = displaySubmenu;
        function displaySubmenu() {
            const subMenu = document.querySelector('.navbar-submenu');

            ( subMenu.classList.contains('active') ) ? subMenu.classList.remove('active') : subMenu.classList.add('active')
        }
        error.forEach( (err)=>{
            setTimeout(()=>{
                err.innerHTML = '';
            },5000);

        } )

    </script>
</body>
</html>