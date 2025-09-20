<!DOCTYPE html>
<?php include 'assets/php/extract.php'; ?>
<html>
<head> <?php include 'assets/php/head.php'; ?> </head>
<body>
  <!-- Header Section -->
  <?php include 'assets/php/header.php'; ?>
  <!-- Main Section -->
  <main>
    <center>
      <div class="max-w-7xl mx-auto p-10">
        <!-- Upcoming Events Carousel -->
        <div id="carousel" class="relative w-full overflow-hidden rounded-2xl shadow-lg">
          <?php if (!empty($upcomingEvents) && count($upcomingEvents) > 0): ?>
          <?php $first = true; foreach($upcomingEvents as $event): ?>
          <div class="carousel-item <?php if($first){echo 'active';$first=false;} ?>">
            <img src="<?= $event['image'] ?>" alt="<?= $event['title'] ?>" class="w-full h-96 object-cover">
            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 p-4 text-white">
              <h2 class="text-2xl font-bold"><?= $event['title'] ?></h2>
              <!-- <p style="text-align:justify"><?= $event['description'] ?></p> -->
              <span class="text-sm">Date: <?= $event['date'] ?></span>
            </div>
          </div>
          <?php endforeach; ?>
          <?php else: ?>
          <div class="carousel-item active"> <div class="w-full h-96 bg-gray-200 flex items-center justify-center"> <h2 class="text-xl font-semibold text-gray-600">No Upcoming Events</h2> </div> </div>
          <?php endif; ?>
          <button id="prev" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white bg-opacity-75 p-2 rounded-full">❮</button>
          <button id="next" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white bg-opacity-75 p-2 rounded-full">❯</button>
        </div>

        <!-- Past Events Section -->
        <div class="mt-12">
          <h2 class="text-3xl font-bold mb-6 text-white text-center">Past Events</h2>
          <?php if (!empty($pastEvents) && count($pastEvents) > 0): ?><p style="text-align: left;color: white;">ℹ️ Click on the event card to view full details and photos</p><br><?php endif; ?>
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php if (!empty($pastEvents) && count($pastEvents) > 0): ?>
            <?php foreach($pastEvents as $event): ?>
            <div class="rounded-2xl shadow-md overflow-hidden cursor-pointer"
              style="background: linear-gradient(135deg, #000000, #00FF66); color:white;"
              onclick='openEventModal(
                  <?= json_encode($event["title"]) ?>,
                  <?= json_encode($event["description"]) ?>,
                  <?= json_encode($event["date"]) ?>,
                  <?= json_encode($event["image"]) ?>,
                  <?= json_encode("assets/image/events/" . $event["id"] . "/") ?>
              )'>
              <img src="<?= $event['image'] ?>" alt="<?= $event['title'] ?>" class="w-full h-48 object-cover">
              <div class="p-4">
                <h3 class="text-xl font-semibold mb-2"><?= $event['title'] ?></h3>
                <!-- <p class="text-black-600 mb-2" style="text-align:justify"><?= $event['description'] ?></p> -->
                <span class="text-sm text-white">Date: <?= $event['date'] ?></span>
              </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-gray-600">No Past Events Available.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </center>
  </main>
  <!-- Event Details Popup -->
<div id="eventModal" class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-lg max-w-3xl w-full p-6 relative overflow-y-auto max-h-[90vh]">
    <!-- Close Button -->
    <button id="closeModal" class="absolute top-3 right-3 text-gray-700 text-2xl">&times;</button>
    <!-- Event Content --> 
    
    <h2 id="modalTitle" class="text-2xl font-bold mb-4" style="text-align: center;"></h2>
    <img id="modalMainImage" class="w-full h-64 object-cover rounded-lg mb-4" alt="Event Image">
    <p id="modalDescription" class="text-gray-700 mb-3" style="text-align: justify;"></p>
    <p id="modalDate" class="text-sm text-gray-500 mb-4" style="text-align: right;"></p>

    <!-- Event Gallery -->
    <div id="modalGallery" class="grid grid-cols-2 md:grid-cols-3 gap-3">
      <!-- Images will load here dynamically -->
    </div>
  </div>
</div>
  <!-- Footer Section -->
  <?php include 'assets/php/footer.php'; ?>
  <script>
    function openEventModal(title, description, date, mainimage, folderPath) {
      console.log(folderPath);
    // Set text content
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalDescription').innerText = description;
    document.getElementById('modalDate').innerText = "Date: " + date;
    document.getElementById('modalMainImage').src = mainimage;

    // Show the modal
    let modal = document.getElementById('eventModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    // Load images
    let gallery = document.getElementById('modalGallery');
    gallery.innerHTML = "<p class='text-gray-500 col-span-full'>Loading images...</p>";

    fetch("assets/php/get_images.php?path=" + folderPath)
      .then(res => res.json())
      .then(images => {
        console.log(images);
        if (images.length > 0) {
          gallery.innerHTML = "";
          images.forEach(img => {
            let imgEl = document.createElement("img");
            imgEl.src = img;
            imgEl.className = "w-full h-40 object-cover rounded-lg shadow";
            gallery.appendChild(imgEl);
          });
        } else {
          gallery.innerHTML = "<p class='text-gray-500 col-span-full'>No images available.</p>";
        }
      });
}

// Close modal
document.getElementById('closeModal').onclick = () => {
    let modal = document.getElementById('eventModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
};
// Close modal when clicking outside the content
document.getElementById('eventModal').addEventListener('click', function(e) {
    const modalContent = this.querySelector('div'); // the inner popup div
    if (!modalContent.contains(e.target)) {
        this.classList.add('hidden');
        this.classList.remove('flex');
    }
});
  </script>

</body>
</html>
