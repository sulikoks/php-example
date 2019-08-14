<?php

define('ROOT', dirname(__FILE__)); // Определение корня, для открытия файла



function binarySearchByKey($file, $isk_var) { // Определяем функцию
  $handle = fopen($file, "r"); // Открываем файл для чтения
  while (!feof($handle)) { // Цикл пока открыт файл
    $string = fgets($handle,4000);  // Записываем в строку содержимое файла
    //
    //echo ($handle);
    //echo ($string);
	$explodedString = explode('\x0A', $string);  // Записываем в массив и разделяем строку разделителем
    array_pop($explodedString);  // Удаление последнего пустого элемента массива
    foreach ($explodedString as $key => $value) { //Для каждого элемента массива
      $arr[] = explode('\t', $value);  //Разделяем строку и записываем в массив, итог массив в массиве
    }
    // Реализация бинарного поиска
    $start = 0; // Определяем начальное значение
    $end = count($arr)-1; // Определяем конечное значение
    while ($start <= $end) { // Цикл пока начальное меньше или равно
      $mid = floor(($start + $end) / 2); // Находим центр между начальным и конечным значением
      $strnatcmp = strnatcmp($arr[$mid][0], $isk_var); // Сравниваем строки среднего и искомого выражения

      if ($strnatcmp > 0) { // Если скомое ближе чем среднее
        $end = $mid - 1; // То меняем конечное значение, и ищем дальше
      } elseif ($strnatcmp < 0) { // Если скомое дальше чем среднее
        $start = $mid + 1; // То меняем начальное значение, и ищем дальше
      } else { // Строки совпадают
        return $arr[$mid][1]; // Возврат значения по ключу
      }
    }
  }
  fclose($handle); // Закрываем файл
  return 'undef';  // Возврат "undef" если ненайден ключ
}
 // Обращение к функции и вывод
echo "Если ключ222 есть в файле: ";
$isk_var = 'ключ222';  // Ключ которые есть
$file = ROOT.'/keynumeric.txt'; // Путь к файлу
echo binarySearchByKey($file, $isk_var)."</br>"; // Обращение к функции и вывод
echo "Если ключ31 есть в файле: ";
$isk_var = 'ключ31'; // Ключ которого нет
echo binarySearchByKey($file, $isk_var)."</br>";
echo "Если ключ331 и его нет в файле: ";
$isk_var = 'ключ331'; // Ключ которого нет
echo binarySearchByKey($file, $isk_var)."</br>"; // Обращение к функции и вывод

 ?>
