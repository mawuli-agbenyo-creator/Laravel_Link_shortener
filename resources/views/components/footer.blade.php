  <!-- Footer -->
  {{-- <footer class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h4>About Us</h4>
          <p>We are a team of web developers who are passionate about building useful tools for the internet.</p>
        </div>
        <div class="col-md-3">
          <h4>Important Pages</h4>
          <ul class="list-unstyled">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms and Conditions</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h4>Social</h4>
          <ul class="list-unstyled">
            <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
            <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
            <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
          </ul>
        </div>
      </div>
      <div class="text-center">
        <p>&copy; 2023 <a href="">URL Shortener</a>, All Rights Reserved.</p>
      </div>
    </div>
  </footer> --}}
  <!-- Bootstrap 4 JS & Include jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-8slVfjLcZllpVl1woYMYepHrt7nzmPrjP9X7jhQ2hWtBX8gjsm5m5vyVGq92qSe+" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Custom JS -->
  <script>
    $(function() {
      $('form').on('submit', function(e) {
        e.preventDefault();
        var longUrl = $('#urlInput').val();
        $.ajax({
          url: '{{ route('shorten') }}', // Use the named route here
          method: 'GET',
          data: { 'original_url': longUrl }, // Pass the longUrl as data
          success: function(response) {
            console.log(response);
            var shortUrl = response.short_url;
            $('#shortUrlResult').html('<p><strong>Your shortened URL is</strong>: <a target="_blank" href="' + shortUrl + '">' + shortUrl + '</a></p>');
          },
          error: function() {
            $('#shortUrlResult').html('<p>There was an error shortening your URL. Please try again.</p>');
          }
        });
      });
    });
</script>

</body>

</html>