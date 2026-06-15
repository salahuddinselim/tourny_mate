<section class="section-contact">
  <div class="container">
    <div class="section-title">
      <div class="label">Get In Touch</div>
      <h2>Contact <span class="hl">Us</span></h2>
      <p>Have a question? We'd love to hear from you.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <form action="contact-controller.php" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="full_name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn-battle w-100">
            <i class="fas fa-paper-plane me-2"></i>Send Message
          </button>
        </form>
      </div>
    </div>
  </div>
</section>
