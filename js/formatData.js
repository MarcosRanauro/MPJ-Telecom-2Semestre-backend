function formatData(input) {
  // Remove qualquer caractere que não seja número
  var value = input.value.replace(/\D/g, '');

  // Limita a 10 caracteres
  if (value.length > 8) {
    value = value.substring(0, 8);
  }

  // Formate a DATA com as barras
  if (value.length >= 2) {
    value = value.substring(0, 2) + '/' + value.substring(2);
  }
  if (value.length >= 7) {
    value = value.substring(0, 5) + '/' + value.substring(5);
  }

  // Permite somente números no campo
  input.value = value;
}