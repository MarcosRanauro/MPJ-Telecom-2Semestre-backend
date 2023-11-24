document.addEventListener("DOMContentLoaded", function () {
  const selectCriteria = document.getElementById("criteria");
  const inputPesquisar = document.getElementById("pesquisar");
  const btnPesquisar = document.getElementById("btn-pesquisar");
  const tabelaUsuarios = document.querySelector(".table tbody");

  btnPesquisar.addEventListener("click", function () {
    realizarPesquisa();
  });

  inputPesquisar.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      event.preventDefault();
      realizarPesquisa();
    }
  });

  function realizarPesquisa() {
    const termoPesquisa = inputPesquisar.value.toLowerCase();
    const criterio = selectCriteria.value;
    const linhas = tabelaUsuarios.querySelectorAll("tr");

    linhas.forEach(function (linha) {
      const textoCelula = linha.querySelector(`td[data-criteria="${criterio}"]`).textContent.toLowerCase();

      if (textoCelula.includes(termoPesquisa)) {
        linha.style.display = "";
      } else {
        linha.style.display = "none";
      }
    });
  }
});