<?
$m_shop = '1726961166'; // id мерчанта
$m_orderid = '100'; // номер счета в системе учета мерчанта
$m_amount = number_format(100, 2, '.', ''); // сумма счета с двумя знаками после точки
$m_curr = 'rub'; // валюта счета
$m_desc = base64_encode('Test');
$m_key = '45pvAEd9RzUBzNLZ';
$arHash = array(
$m_shop,
$m_orderid,
$m_amount,
$m_curr,
$m_desc
);
// Добавляем секретный ключ
$arHash[] = $m_key;
// Формируем подпись
$sign = strtoupper(hash('sha256', implode(":", $arHash)));
?>
