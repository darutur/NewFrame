</div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.navbar-nav [data-toggle="tooltip"]').tooltip();
                $('.navbar-twitch-toggle').on('click', function (event) {
                    event.preventDefault();
                    $('.navbar-twitch').toggleClass('open');
                });
            });
        </script>


    </body>
</html>