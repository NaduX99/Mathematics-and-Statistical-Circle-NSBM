    <!-- page content ends here -->
  </main>
</div>

<footer class="admin-footer">
  <p>© <?= date('Y') ?> Mathematics & Statistics Circle — NSBM Green University</p>
</footer>

<script>

  document.querySelector('.hamburger')?.addEventListener('click', () => {
    document.getElementById('adminSidebar')?.classList.toggle('open');
    document.body.classList.toggle('sidebar-open',
      document.getElementById('adminSidebar')?.classList.contains('open'));
  });
</script>
</body>
</html>
