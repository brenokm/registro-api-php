<?php 
if (isset($_SESSION['mensagem'])): ?>
    
    <div id="alerta" class="alert-overlay">
        <div class="alert-card">
            <p><?= $_SESSION['mensagem']; ?></p>
            <button onclick="fecharAlerta()">OK</button>
        </div>
    </div>

    <?php unset($_SESSION['mensagem']); ?>
<?php endif; ?>

<script>
function fecharAlerta() {
    document.getElementById('alerta').style.display = 'none';
}
</script>