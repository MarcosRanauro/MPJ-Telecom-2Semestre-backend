<?php 
function formatData($data) {
  if (empty($data) || $data == '0000-00-00') {
    return 'Não encontrado';
  }

  $dataFormatada = date('d/m/Y', strtotime($data));
  return $dataFormatada;
}

?>