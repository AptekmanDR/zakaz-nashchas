<?php
// Отклоняем запросы с IP-адресов, которые не принадлежат Payeer
if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189',
11
'149.202.17.210'))) return;
if (isset($_POST['m_operation_id']) && isset($_POST['m_sign']))
{
$m_key = '45pvAEd9RzUBzNLZ';
// Формируем массив для генерации подписи
$arHash = array(
$_POST['m_operation_id'],
$_POST['m_operation_ps'],
$_POST['m_operation_date'],
$_POST['m_operation_pay_date'],
$_POST['m_shop'],
$_POST['m_orderid'],
$_POST['m_amount'],
$_POST['m_curr'],
$_POST['m_desc'],
$_POST['m_status']
);
// Если были переданы дополнительные параметры, то добавляем их в
массив
if (isset($_POST['m_params']))
{
$arHash[] = $_POST['m_params'];
}
// Добавляем в массив секретный ключ
$arHash[] = $m_key;
// Формируем подпись
$sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
// Если подписи совпадают и статус платежа “Выполнен”
if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success')
{
// Здесь можно пометить счет как оплаченный или зачислить денежные
средства Вашему клиенту
// Возвращаем, что платеж был успешно обработан
ob_end_clean(); exit($_POST['m_orderid'].'|success');
}
// В противном случае возвращаем ошибку
ob_end_clean(); exit($_POST['m_orderid'].'|error');
}
