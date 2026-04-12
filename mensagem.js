export function mostrarMensagem(texto) 
{
  let alerta = document.getElementById("alerta");
  if (!alerta) {
    alerta = document.createElement("div");
    alerta.id = "alerta";
    alerta.className = "alert-overlay";

    alerta.innerHTML = `
       
        <div id="alerta" class="alert-overlay">
            <div class="alert-card">
                <p id="mensagem-texto"></p>
                <button id="btn-fechar">OK</button>
            </div>
        </div>


        `;

    document.body.appendChild(alerta);


    document.getElementById("btn-fechar").onclick = () => {
      alerta.style.display = "none";
    };
  }


  document.getElementById("mensagem-texto").innerText = texto;

  alerta.style.display = "flex";
}
