<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!$_SESSION['user_id']) {
    header("location: /login");
}

$user_id = $_SESSION['user_id'];
$gender = $_GET['gender'];
$get_id = $_GET['id'];
//die();


$sql = "SELECT * FROM `users` WHERE ID = '" . $_SESSION['user_id'] . "'";
$exe = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($exe);

$firstname = $fetch['firstname'];
$username = $fetch['username'];
$middlename = $fetch['middlename'];
$lastname = $fetch['lastname'];


$relationship = $_GET['relationship'];
//echo $relationship;
//die()

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Family page</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/js/script.js" />
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/themify-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        #search-results {
            max-height: 200px;
            /* set a fixed height for the dropdown */
            overflow-y: auto;
            /* enable vertical scrolling */
        }

        /* Define the default style for the element */
        .custom-card {
            border: 1px solid #ccc;
            background-color: #fff;
            color: #000;
        }

        /* Define the hover style for the element */
        .custom-card:hover {
            border: 1px solid black;
            background-color: darkgray;
            color: black;
        }

        /* Style the file input button */
        .custom-file-upload {
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            background-color: #f8f8f8;
            color: #333;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Hide the default file input button */
        input[type="file"] {
            display: none;
        }

        /* Add hover effect to the file input button */
        .custom-file-upload:hover {
            background-color: #e5e5e5;
        }

        .error {
            color: red;
        }

        .error-border {
            border: 1px solid red;
        }
    </style>
</head>

<body>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/subheader.php';

?>
<section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
        <div class="row">
            <div class="">
                <div class="card">
                    <div class=" row pt-4 text-black">
                        <div class=" col-md-12 ">
                            <div class="p-4 edit-profile-border">
                                <div class="row">

                                    <div class="col-md-12 ">
                                        <h3 class="pt-3">User Family</h3>
                                    </div>
                                    <div class="">
                                        <hr>
                                    </div>
                                    <form id="myForm" method="POST" action="/php/add-family.php" enctype="multipart/form-data">
                                        <div class="row ">
                                            <div class="col-md-6 p-3">
                                                <div class="row">
                                                    <?php
                                                    if (isset($_SESSION['family_cancelation_message'])) {
                                                        session_start();
                                                        ?>
                                                        <div class="alert alert-success" role="alert">
                                                            <?php
                                                            echo $_SESSION['family_cancelation_message'];
                                                            unset($_SESSION['family_cancelation_message']);
                                                            ?>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="mb-4" id="hide-name-input">
                                                        <div class="form-outline self_hide">
                                                            <label for="input-field" class="mb-2">Name</label>
                                                            <input type="hidden" value="" id="id-hidd">
                                                            <input type="text" id="input-field" placeholder="" class="form-control" autocomplete="off" style="border-radius: 3px; font-size: medium;" />
                                                            <div id="error-message" style="color: red;"></div>
                                                            <input type="hidden" name="genderinp" id="genderInput">
                                                            <div id="search-results"></div>
                                                        </div>
                                                    </div>
                                                    <div class="" id="single-input">
                                                    </div>
                                                    <input type="hidden" id="relationship" name="relationship" value="<?php echo $relationship; ?>" placeholder="" class="form-control" style="border-radius: 3px; font-size: medium;">
                                                    <div class="additional-fields" id="hide-divs1" style="display:none;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="field-1" class="mb-2">First Name:</label>
                                                                <input type="text" id="first_name" name="firstname" placeholder="" class="form-control custom_click" style="border-radius: 3px; font-size: medium;">
                                                                <div id="first_name_error" style="color: red;"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="field-2" class="mb-2">Middle Name:</label>
                                                                <input type="text" id="input-fields" name="middlename" placeholder="" class="form-control custom_click" style="border-radius: 3px; font-size: medium;">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="field-2" class="mb-2">Last Name:</label>
                                                                <input type="text" id="last_name" name="lastname" placeholder="" class="form-control custom_click" style="border-radius: 3px; font-size: medium;">
                                                                <div id="last_name_error" style="color: red;"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="field-2" class="mb-2">Suffix (Jr., M.D., etc.):</label>
                                                                <input type="text" id="input-fields" name="suffix" placeholder="" class="form-control custom_click" style="border-radius: 3px; font-size: medium;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 " id="hide-divs2">
                                                    <div class="form-outline">
                                                        <label for="" class="my-2">Their Date of Birth:</label>
                                                        <br>
                                                        <select name="date_of_birth_year" style="border: none;" class="form-control-sm input">
                                                            <option value="2023">2023</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2020">2020</option>
                                                            <option value="2019">2019</option>
                                                            <option value="2018">2018</option>
                                                            <option value="2017">2017</option>
                                                            <option value="2016">2016</option>
                                                            <option value="2015">2015</option>
                                                            <option value="2014">2014</option>
                                                            <option value="2013">2013</option>
                                                            <option value="2012">2012</option>
                                                            <option value="2011">2011</option>
                                                            <option value="2010">2010</option>
                                                            <option value="2009">2009</option>
                                                            <option value="2008">2008</option>
                                                            <option value="2007">2007</option>
                                                            <option value="2006">2006</option>
                                                            <option value="2005">2005</option>
                                                            <option value="2004">2004</option>
                                                            <option value="2003">2003</option>
                                                            <option value="2002">2002</option>
                                                            <option value="2001">2001</option>
                                                            <option value="2000">2000</option>
                                                            <option value="1999">1999</option>
                                                            <option value="1998">1998</option>
                                                            <option value="1997">1997</option>
                                                            <option value="1996">1996</option>
                                                            <option value="1995">1995</option>
                                                            <option value="1994">1994</option>
                                                            <option value="1993">1993</option>
                                                            <option value="1992">1992</option>
                                                            <option value="1991">1991</option>
                                                            <option value="1990">1990</option>
                                                            <option value="1989">1989</option>
                                                            <option value="1988">1988</option>
                                                            <option value="1987">1987</option>
                                                            <option value="1986">1986</option>
                                                            <option value="1985">1985</option>
                                                            <option value="1984">1984</option>
                                                            <option value="1983">1983</option>
                                                            <option value="1982">1982</option>
                                                            <option value="1981">1981</option>
                                                            <option value="1980">1980</option>
                                                            <option value="1979">1979</option>
                                                            <option value="1978">1978</option>
                                                            <option value="1977">1977</option>
                                                            <option value="1976">1976</option>
                                                            <option value="1975">1975</option>
                                                            <option value="1974">1974</option>
                                                            <option value="1973">1973</option>
                                                            <option value="1972">1972</option>
                                                            <option value="1971">1971</option>
                                                            <option value="1970">1970</option>
                                                            <option value="1969">1969</option>
                                                            <option value="1968">1968</option>
                                                            <option value="1967">1967</option>
                                                            <option value="1966">1966</option>
                                                            <option value="1965">1965</option>
                                                            <option value="1964">1964</option>
                                                            <option value="1963">1963</option>
                                                            <option value="1962">1962</option>
                                                            <option value="1961">1961</option>
                                                            <option value="1960">1960</option>
                                                            <option value="1959">1959</option>
                                                            <option value="1958">1958</option>
                                                            <option value="1957">1957</option>
                                                            <option value="1956">1956</option>
                                                            <option value="1955">1955</option>
                                                            <option value="1954">1954</option>
                                                            <option value="1953">1953</option>
                                                            <option value="1952">1952</option>
                                                            <option value="1951">1951</option>
                                                            <option value="1950">1950</option>
                                                            <option value="1949">1949</option>
                                                            <option value="1948">1948</option>
                                                            <option value="1947">1947</option>
                                                            <option value="1946">1946</option>
                                                            <option value="1945">1945</option>
                                                            <option value="1944">1944</option>
                                                            <option value="1943">1943</option>
                                                            <option value="1942">1942</option>
                                                            <option value="1941">1941</option>
                                                            <option value="1940">1940</option>
                                                            <option value="1939">1939</option>
                                                            <option value="1938">1938</option>
                                                            <option value="1937">1937</option>
                                                            <option value="1936">1936</option>
                                                            <option value="1935">1935</option>
                                                            <option value="1934">1934</option>
                                                            <option value="1933">1933</option>
                                                            <option value="1932">1932</option>
                                                            <option value="1931">1931</option>
                                                            <option value="1930">1930</option>
                                                            <option value="1929">1929</option>
                                                            <option value="1928">1928</option>
                                                            <option value="1927">1927</option>
                                                            <option value="1926">1926</option>
                                                            <option value="1925">1925</option>
                                                            <option value="1924">1924</option>
                                                            <option value="1923">1923</option>
                                                            <option value="1922">1922</option>
                                                            <option value="1921">1921</option>
                                                            <option value="1920">1920</option>
                                                            <option value="1919">1919</option>
                                                            <option value="1918">1918</option>
                                                            <option value="1917">1917</option>
                                                            <option value="1916">1916</option>
                                                            <option value="1915">1915</option>
                                                            <option value="1914">1914</option>
                                                            <option value="1913">1913</option>
                                                            <option value="1912">1912</option>
                                                            <option value="1911">1911</option>
                                                            <option value="1910">1910</option>
                                                            <option value="1909">1909</option>
                                                            <option value="1908">1908</option>
                                                            <option value="1907">1907</option>
                                                            <option value="1906">1906</option>
                                                            <option value="1905">1905</option>
                                                            <option value="1904">1904</option>
                                                            <option value="1903">1903</option>
                                                            <option value="1902">1902</option>
                                                            <option value="1901">1901</option>
                                                            <option value="1900">1900</option>
                                                            <option value="1899">1899</option>
                                                            <option value="1898">1898</option>
                                                            <option value="1897">1897</option>
                                                            <option value="1896">1896</option>
                                                            <option value="1895">1895</option>
                                                            <option value="1894">1894</option>
                                                            <option value="1893">1893</option>
                                                            <option value="1892">1892</option>
                                                            <option value="1891">1891</option>
                                                            <option value="1890">1890</option>
                                                            <option value="1889">1889</option>
                                                            <option value="1888">1888</option>
                                                            <option value="1887">1887</option>
                                                            <option value="1886">1886</option>
                                                            <option value="1885">1885</option>
                                                            <option value="1884">1884</option>
                                                            <option value="1883">1883</option>
                                                            <option value="1882">1882</option>
                                                            <option value="1881">1881</option>
                                                            <option value="1880">1880</option>
                                                            <option value="1879">1879</option>
                                                            <option value="1878">1878</option>
                                                            <option value="1877">1877</option>
                                                            <option value="1876">1876</option>
                                                            <option value="1875">1875</option>
                                                            <option value="1874">1874</option>
                                                            <option value="1873">1873</option>
                                                            <option value="1872">1872</option>
                                                            <option value="1871">1871</option>
                                                            <option value="1870">1870</option>
                                                            <option value="1869">1869</option>
                                                            <option value="1868">1868</option>
                                                            <option value="1867">1867</option>
                                                            <option value="1866">1866</option>
                                                            <option value="1865">1865</option>
                                                            <option value="1864">1864</option>
                                                            <option value="1863">1863</option>
                                                            <option value="1862">1862</option>
                                                            <option value="1861">1861</option>
                                                            <option value="1860">1860</option>
                                                            <option value="1859">1859</option>
                                                            <option value="1858">1858</option>
                                                            <option value="1857">1857</option>
                                                            <option value="1856">1856</option>
                                                            <option value="1855">1855</option>
                                                            <option value="1854">1854</option>
                                                            <option value="1853">1853</option>
                                                            <option value="1852">1852</option>
                                                            <option value="1851">1851</option>
                                                            <option value="1850">1850</option>
                                                            <option value="1849">1849</option>
                                                            <option value="1848">1848</option>
                                                            <option value="1847">1847</option>
                                                            <option value="1846">1846</option>
                                                            <option value="1845">1845</option>
                                                            <option value="1844">1844</option>
                                                            <option value="1843">1843</option>
                                                            <option value="1842">1842</option>
                                                            <option value="1841">1841</option>
                                                            <option value="1840">1840</option>
                                                            <option value="1839">1839</option>
                                                            <option value="1838">1838</option>
                                                            <option value="1837">1837</option>
                                                            <option value="1836">1836</option>
                                                            <option value="1835">1835</option>
                                                            <option value="1834">1834</option>
                                                            <option value="1833">1833</option>
                                                            <option value="1832">1832</option>
                                                            <option value="1831">1831</option>
                                                            <option value="1830">1830</option>
                                                            <option value="1829">1829</option>
                                                            <option value="1828">1828</option>
                                                            <option value="1827">1827</option>
                                                            <option value="1826">1826</option>
                                                            <option value="1825">1825</option>
                                                            <option value="1824">1824</option>
                                                            <option value="1823">1823</option>
                                                            <option value="1822">1822</option>
                                                            <option value="1821">1821</option>
                                                            <option value="1820">1820</option>
                                                            <option value="1819">1819</option>
                                                            <option value="1818">1818</option>
                                                            <option value="1817">1817</option>
                                                            <option value="1816">1816</option>
                                                            <option value="1815">1815</option>
                                                            <option value="1814">1814</option>
                                                            <option value="1813">1813</option>
                                                            <option value="1812">1812</option>
                                                            <option value="1811">1811</option>
                                                            <option value="1810">1810</option>
                                                            <option value="1809">1809</option>
                                                            <option value="1808">1808</option>
                                                            <option value="1807">1807</option>
                                                            <option value="1806">1806</option>
                                                            <option value="1805">1805</option>
                                                            <option value="1804">1804</option>
                                                            <option value="1803">1803</option>
                                                            <option value="1802">1802</option>
                                                            <option value="1801">1801</option>
                                                            <option value="1800">1800</option>
                                                            <option value="1799">1799</option>
                                                            <option value="1798">1798</option>
                                                            <option value="1797">1797</option>
                                                            <option value="1796">1796</option>
                                                            <option value="1795">1795</option>
                                                            <option value="1794">1794</option>
                                                            <option value="1793">1793</option>
                                                            <option value="1792">1792</option>
                                                            <option value="1791">1791</option>
                                                            <option value="1790">1790</option>
                                                            <option value="1789">1789</option>
                                                            <option value="1788">1788</option>
                                                            <option value="1787">1787</option>
                                                            <option value="1786">1786</option>
                                                            <option value="1785">1785</option>
                                                            <option value="1784">1784</option>
                                                            <option value="1783">1783</option>
                                                            <option value="1782">1782</option>
                                                            <option value="1781">1781</option>
                                                            <option value="1780">1780</option>
                                                            <option value="1779">1779</option>
                                                            <option value="1778">1778</option>
                                                            <option value="1777">1777</option>
                                                            <option value="1776">1776</option>
                                                            <option value="1775">1775</option>
                                                            <option value="1774">1774</option>
                                                            <option value="1773">1773</option>
                                                            <option value="1772">1772</option>
                                                            <option value="1771">1771</option>
                                                            <option value="1770">1770</option>
                                                            <option value="1769">1769</option>
                                                            <option value="1768">1768</option>
                                                            <option value="1767">1767</option>
                                                            <option value="1766">1766</option>
                                                            <option value="1765">1765</option>
                                                            <option value="1764">1764</option>
                                                            <option value="1763">1763</option>
                                                            <option value="1762">1762</option>
                                                            <option value="1761">1761</option>
                                                            <option value="1760">1760</option>
                                                            <option value="1759">1759</option>
                                                            <option value="1758">1758</option>
                                                            <option value="1757">1757</option>
                                                            <option value="1756">1756</option>
                                                            <option value="1755">1755</option>
                                                            <option value="1754">1754</option>
                                                            <option value="1753">1753</option>
                                                            <option value="1752">1752</option>
                                                            <option value="1751">1751</option>
                                                            <option value="1750">1750</option>
                                                            <option value="1749">1749</option>
                                                            <option value="1748">1748</option>
                                                            <option value="1747">1747</option>
                                                            <option value="1746">1746</option>
                                                            <option value="1745">1745</option>
                                                            <option value="1744">1744</option>
                                                            <option value="1743">1743</option>
                                                            <option value="1742">1742</option>
                                                            <option value="1741">1741</option>
                                                            <option value="1740">1740</option>
                                                            <option value="1739">1739</option>
                                                            <option value="1738">1738</option>
                                                            <option value="1737">1737</option>
                                                            <option value="1736">1736</option>
                                                            <option value="1735">1735</option>
                                                            <option value="1734">1734</option>
                                                            <option value="1733">1733</option>
                                                            <option value="1732">1732</option>
                                                            <option value="1731">1731</option>
                                                            <option value="1730">1730</option>
                                                            <option value="1729">1729</option>
                                                            <option value="1728">1728</option>
                                                            <option value="1727">1727</option>
                                                            <option value="1726">1726</option>
                                                            <option value="1725">1725</option>
                                                            <option value="1724">1724</option>
                                                            <option value="1723">1723</option>
                                                            <option value="1722">1722</option>
                                                            <option value="1721">1721</option>
                                                            <option value="1720">1720</option>
                                                            <option value="1719">1719</option>
                                                            <option value="1718">1718</option>
                                                            <option value="1717">1717</option>
                                                            <option value="1716">1716</option>
                                                            <option value="1715">1715</option>
                                                            <option value="1714">1714</option>
                                                            <option value="1713">1713</option>
                                                            <option value="1712">1712</option>
                                                            <option value="1711">1711</option>
                                                            <option value="1710">1710</option>
                                                            <option value="1709">1709</option>
                                                            <option value="1708">1708</option>
                                                            <option value="1707">1707</option>
                                                            <option value="1706">1706</option>
                                                            <option value="1705">1705</option>
                                                            <option value="1704">1704</option>
                                                            <option value="1703">1703</option>
                                                            <option value="1702">1702</option>
                                                            <option value="1701">1701</option>
                                                            <option value="1700">1700</option>
                                                        </select>
                                                        <select name="date_of_birth_month" style="border: none;" class="form-control-sm input">
                                                            <option value="01">01</option>
                                                            <option value="02">02</option>
                                                            <option value="03">03</option>
                                                            <option value="04">04</option>
                                                            <option value="05">05</option>
                                                            <option value="06">06</option>
                                                            <option value="07">07</option>
                                                            <option value="08">08</option>
                                                            <option value="09">09</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                        </select>
                                                        <select name="date_of_birth_day" style="border: none;" class="form-control-sm input">
                                                            <option value="01">01</option>
                                                            <option value="02">02</option>
                                                            <option value="03">03</option>
                                                            <option value="04">04</option>
                                                            <option value="05">05</option>
                                                            <option value="06">06</option>
                                                            <option value="07">07</option>
                                                            <option value="08">08</option>
                                                            <option value="09">09</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20</option>
                                                            <option value="21">21</option>
                                                            <option value="22">22</option>
                                                            <option value="23">23</option>
                                                            <option value="24">24</option>
                                                            <option value="25">25</option>
                                                            <option value="26">26</option>
                                                            <option value="27">27</option>
                                                            <option value="28">28</option>
                                                            <option value="29">29</option>
                                                            <option value="30">30</option>
                                                            <option value="31">31</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-4 " id="hide-divs3">
                                                    <div class="form-outline"></div>
                                                    <div class="hasPassedAway">
                                                        <label for="checkPassedAway" class="mb-2">
                                                            Has passed away ?
                                                            <label>
                                                                <input type="checkbox" id="show-divs">
                                                            </label>
                                                            <div class="my-divs">

                                                                <div class="form-outline mt-2">
                                                                    <label for="" class="mb-2"> Date of Death (YYYY-MM-DD):</label>
                                                                    <br>
                                                                    <select name="date_of_death_year" style="border: none;" id="slect-id" class="form-control-sm input">
                                                                        <option value="2023">2023</option>
                                                                        <option value="2022">2022</option>
                                                                        <option value="2021">2021</option>
                                                                        <option value="2020">2020</option>
                                                                        <option value="2019">2019</option>
                                                                        <option value="2018">2018</option>
                                                                        <option value="2017">2017</option>
                                                                        <option value="2016">2016</option>
                                                                        <option value="2015">2015</option>
                                                                        <option value="2014">2014</option>
                                                                        <option value="2013">2013</option>
                                                                        <option value="2012">2012</option>
                                                                        <option value="2011">2011</option>
                                                                        <option value="2010">2010</option>
                                                                        <option value="2009">2009</option>
                                                                        <option value="2008">2008</option>
                                                                        <option value="2007">2007</option>
                                                                        <option value="2006">2006</option>
                                                                        <option value="2005">2005</option>
                                                                        <option value="2004">2004</option>
                                                                        <option value="2003">2003</option>
                                                                        <option value="2002">2002</option>
                                                                        <option value="2001">2001</option>
                                                                        <option value="2000">2000</option>
                                                                        <option value="1999">1999</option>
                                                                        <option value="1998">1998</option>
                                                                        <option value="1997">1997</option>
                                                                        <option value="1996">1996</option>
                                                                        <option value="1995">1995</option>
                                                                        <option value="1994">1994</option>
                                                                        <option value="1993">1993</option>
                                                                        <option value="1992">1992</option>
                                                                        <option value="1991">1991</option>
                                                                        <option value="1990">1990</option>
                                                                        <option value="1989">1989</option>
                                                                        <option value="1988">1988</option>
                                                                        <option value="1987">1987</option>
                                                                        <option value="1986">1986</option>
                                                                        <option value="1985">1985</option>
                                                                        <option value="1984">1984</option>
                                                                        <option value="1983">1983</option>
                                                                        <option value="1982">1982</option>
                                                                        <option value="1981">1981</option>
                                                                        <option value="1980">1980</option>
                                                                        <option value="1979">1979</option>
                                                                        <option value="1978">1978</option>
                                                                        <option value="1977">1977</option>
                                                                        <option value="1976">1976</option>
                                                                        <option value="1975">1975</option>
                                                                        <option value="1974">1974</option>
                                                                        <option value="1973">1973</option>
                                                                        <option value="1972">1972</option>
                                                                        <option value="1971">1971</option>
                                                                        <option value="1970">1970</option>
                                                                        <option value="1969">1969</option>
                                                                        <option value="1968">1968</option>
                                                                        <option value="1967">1967</option>
                                                                        <option value="1966">1966</option>
                                                                        <option value="1965">1965</option>
                                                                        <option value="1964">1964</option>
                                                                        <option value="1963">1963</option>
                                                                        <option value="1962">1962</option>
                                                                        <option value="1961">1961</option>
                                                                        <option value="1960">1960</option>
                                                                        <option value="1959">1959</option>
                                                                        <option value="1958">1958</option>
                                                                        <option value="1957">1957</option>
                                                                        <option value="1956">1956</option>
                                                                        <option value="1955">1955</option>
                                                                        <option value="1954">1954</option>
                                                                        <option value="1953">1953</option>
                                                                        <option value="1952">1952</option>
                                                                        <option value="1951">1951</option>
                                                                        <option value="1950">1950</option>
                                                                        <option value="1949">1949</option>
                                                                        <option value="1948">1948</option>
                                                                        <option value="1947">1947</option>
                                                                        <option value="1946">1946</option>
                                                                        <option value="1945">1945</option>
                                                                        <option value="1944">1944</option>
                                                                        <option value="1943">1943</option>
                                                                        <option value="1942">1942</option>
                                                                        <option value="1941">1941</option>
                                                                        <option value="1940">1940</option>
                                                                        <option value="1939">1939</option>
                                                                        <option value="1938">1938</option>
                                                                        <option value="1937">1937</option>
                                                                        <option value="1936">1936</option>
                                                                        <option value="1935">1935</option>
                                                                        <option value="1934">1934</option>
                                                                        <option value="1933">1933</option>
                                                                        <option value="1932">1932</option>
                                                                        <option value="1931">1931</option>
                                                                        <option value="1930">1930</option>
                                                                        <option value="1929">1929</option>
                                                                        <option value="1928">1928</option>
                                                                        <option value="1927">1927</option>
                                                                        <option value="1926">1926</option>
                                                                        <option value="1925">1925</option>
                                                                        <option value="1924">1924</option>
                                                                        <option value="1923">1923</option>
                                                                        <option value="1922">1922</option>
                                                                        <option value="1921">1921</option>
                                                                        <option value="1920">1920</option>
                                                                        <option value="1919">1919</option>
                                                                        <option value="1918">1918</option>
                                                                        <option value="1917">1917</option>
                                                                        <option value="1916">1916</option>
                                                                        <option value="1915">1915</option>
                                                                        <option value="1914">1914</option>
                                                                        <option value="1913">1913</option>
                                                                        <option value="1912">1912</option>
                                                                        <option value="1911">1911</option>
                                                                        <option value="1910">1910</option>
                                                                        <option value="1909">1909</option>
                                                                        <option value="1908">1908</option>
                                                                        <option value="1907">1907</option>
                                                                        <option value="1906">1906</option>
                                                                        <option value="1905">1905</option>
                                                                        <option value="1904">1904</option>
                                                                        <option value="1903">1903</option>
                                                                        <option value="1902">1902</option>
                                                                        <option value="1901">1901</option>
                                                                        <option value="1900">1900</option>
                                                                        <option value="1899">1899</option>
                                                                        <option value="1898">1898</option>
                                                                        <option value="1897">1897</option>
                                                                        <option value="1896">1896</option>
                                                                        <option value="1895">1895</option>
                                                                        <option value="1894">1894</option>
                                                                        <option value="1893">1893</option>
                                                                        <option value="1892">1892</option>
                                                                        <option value="1891">1891</option>
                                                                        <option value="1890">1890</option>
                                                                        <option value="1889">1889</option>
                                                                        <option value="1888">1888</option>
                                                                        <option value="1887">1887</option>
                                                                        <option value="1886">1886</option>
                                                                        <option value="1885">1885</option>
                                                                        <option value="1884">1884</option>
                                                                        <option value="1883">1883</option>
                                                                        <option value="1882">1882</option>
                                                                        <option value="1881">1881</option>
                                                                        <option value="1880">1880</option>
                                                                        <option value="1879">1879</option>
                                                                        <option value="1878">1878</option>
                                                                        <option value="1877">1877</option>
                                                                        <option value="1876">1876</option>
                                                                        <option value="1875">1875</option>
                                                                        <option value="1874">1874</option>
                                                                        <option value="1873">1873</option>
                                                                        <option value="1872">1872</option>
                                                                        <option value="1871">1871</option>
                                                                        <option value="1870">1870</option>
                                                                        <option value="1869">1869</option>
                                                                        <option value="1868">1868</option>
                                                                        <option value="1867">1867</option>
                                                                        <option value="1866">1866</option>
                                                                        <option value="1865">1865</option>
                                                                        <option value="1864">1864</option>
                                                                        <option value="1863">1863</option>
                                                                        <option value="1862">1862</option>
                                                                        <option value="1861">1861</option>
                                                                        <option value="1860">1860</option>
                                                                        <option value="1859">1859</option>
                                                                        <option value="1858">1858</option>
                                                                        <option value="1857">1857</option>
                                                                        <option value="1856">1856</option>
                                                                        <option value="1855">1855</option>
                                                                        <option value="1854">1854</option>
                                                                        <option value="1853">1853</option>
                                                                        <option value="1852">1852</option>
                                                                        <option value="1851">1851</option>
                                                                        <option value="1850">1850</option>
                                                                        <option value="1849">1849</option>
                                                                        <option value="1848">1848</option>
                                                                        <option value="1847">1847</option>
                                                                        <option value="1846">1846</option>
                                                                        <option value="1845">1845</option>
                                                                        <option value="1844">1844</option>
                                                                        <option value="1843">1843</option>
                                                                        <option value="1842">1842</option>
                                                                        <option value="1841">1841</option>
                                                                        <option value="1840">1840</option>
                                                                        <option value="1839">1839</option>
                                                                        <option value="1838">1838</option>
                                                                        <option value="1837">1837</option>
                                                                        <option value="1836">1836</option>
                                                                        <option value="1835">1835</option>
                                                                        <option value="1834">1834</option>
                                                                        <option value="1833">1833</option>
                                                                        <option value="1832">1832</option>
                                                                        <option value="1831">1831</option>
                                                                        <option value="1830">1830</option>
                                                                        <option value="1829">1829</option>
                                                                        <option value="1828">1828</option>
                                                                        <option value="1827">1827</option>
                                                                        <option value="1826">1826</option>
                                                                        <option value="1825">1825</option>
                                                                        <option value="1824">1824</option>
                                                                        <option value="1823">1823</option>
                                                                        <option value="1822">1822</option>
                                                                        <option value="1821">1821</option>
                                                                        <option value="1820">1820</option>
                                                                        <option value="1819">1819</option>
                                                                        <option value="1818">1818</option>
                                                                        <option value="1817">1817</option>
                                                                        <option value="1816">1816</option>
                                                                        <option value="1815">1815</option>
                                                                        <option value="1814">1814</option>
                                                                        <option value="1813">1813</option>
                                                                        <option value="1812">1812</option>
                                                                        <option value="1811">1811</option>
                                                                        <option value="1810">1810</option>
                                                                        <option value="1809">1809</option>
                                                                        <option value="1808">1808</option>
                                                                        <option value="1807">1807</option>
                                                                        <option value="1806">1806</option>
                                                                        <option value="1805">1805</option>
                                                                        <option value="1804">1804</option>
                                                                        <option value="1803">1803</option>
                                                                        <option value="1802">1802</option>
                                                                        <option value="1801">1801</option>
                                                                        <option value="1800">1800</option>
                                                                        <option value="1799">1799</option>
                                                                        <option value="1798">1798</option>
                                                                        <option value="1797">1797</option>
                                                                        <option value="1796">1796</option>
                                                                        <option value="1795">1795</option>
                                                                        <option value="1794">1794</option>
                                                                        <option value="1793">1793</option>
                                                                        <option value="1792">1792</option>
                                                                        <option value="1791">1791</option>
                                                                        <option value="1790">1790</option>
                                                                        <option value="1789">1789</option>
                                                                        <option value="1788">1788</option>
                                                                        <option value="1787">1787</option>
                                                                        <option value="1786">1786</option>
                                                                        <option value="1785">1785</option>
                                                                        <option value="1784">1784</option>
                                                                        <option value="1783">1783</option>
                                                                        <option value="1782">1782</option>
                                                                        <option value="1781">1781</option>
                                                                        <option value="1780">1780</option>
                                                                        <option value="1779">1779</option>
                                                                        <option value="1778">1778</option>
                                                                        <option value="1777">1777</option>
                                                                        <option value="1776">1776</option>
                                                                        <option value="1775">1775</option>
                                                                        <option value="1774">1774</option>
                                                                        <option value="1773">1773</option>
                                                                        <option value="1772">1772</option>
                                                                        <option value="1771">1771</option>
                                                                        <option value="1770">1770</option>
                                                                        <option value="1769">1769</option>
                                                                        <option value="1768">1768</option>
                                                                        <option value="1767">1767</option>
                                                                        <option value="1766">1766</option>
                                                                        <option value="1765">1765</option>
                                                                        <option value="1764">1764</option>
                                                                        <option value="1763">1763</option>
                                                                        <option value="1762">1762</option>
                                                                        <option value="1761">1761</option>
                                                                        <option value="1760">1760</option>
                                                                        <option value="1759">1759</option>
                                                                        <option value="1758">1758</option>
                                                                        <option value="1757">1757</option>
                                                                        <option value="1756">1756</option>
                                                                        <option value="1755">1755</option>
                                                                        <option value="1754">1754</option>
                                                                        <option value="1753">1753</option>
                                                                        <option value="1752">1752</option>
                                                                        <option value="1751">1751</option>
                                                                        <option value="1750">1750</option>
                                                                        <option value="1749">1749</option>
                                                                        <option value="1748">1748</option>
                                                                        <option value="1747">1747</option>
                                                                        <option value="1746">1746</option>
                                                                        <option value="1745">1745</option>
                                                                        <option value="1744">1744</option>
                                                                        <option value="1743">1743</option>
                                                                        <option value="1742">1742</option>
                                                                        <option value="1741">1741</option>
                                                                        <option value="1740">1740</option>
                                                                        <option value="1739">1739</option>
                                                                        <option value="1738">1738</option>
                                                                        <option value="1737">1737</option>
                                                                        <option value="1736">1736</option>
                                                                        <option value="1735">1735</option>
                                                                        <option value="1734">1734</option>
                                                                        <option value="1733">1733</option>
                                                                        <option value="1732">1732</option>
                                                                        <option value="1731">1731</option>
                                                                        <option value="1730">1730</option>
                                                                        <option value="1729">1729</option>
                                                                        <option value="1728">1728</option>
                                                                        <option value="1727">1727</option>
                                                                        <option value="1726">1726</option>
                                                                        <option value="1725">1725</option>
                                                                        <option value="1724">1724</option>
                                                                        <option value="1723">1723</option>
                                                                        <option value="1722">1722</option>
                                                                        <option value="1721">1721</option>
                                                                        <option value="1720">1720</option>
                                                                        <option value="1719">1719</option>
                                                                        <option value="1718">1718</option>
                                                                        <option value="1717">1717</option>
                                                                        <option value="1716">1716</option>
                                                                        <option value="1715">1715</option>
                                                                        <option value="1714">1714</option>
                                                                        <option value="1713">1713</option>
                                                                        <option value="1712">1712</option>
                                                                        <option value="1711">1711</option>
                                                                        <option value="1710">1710</option>
                                                                        <option value="1709">1709</option>
                                                                        <option value="1708">1708</option>
                                                                        <option value="1707">1707</option>
                                                                        <option value="1706">1706</option>
                                                                        <option value="1705">1705</option>
                                                                        <option value="1704">1704</option>
                                                                        <option value="1703">1703</option>
                                                                        <option value="1702">1702</option>
                                                                        <option value="1701">1701</option>
                                                                        <option value="1700">1700</option>
                                                                    </select>
                                                                    <select name="date_of_death_month" style="border: none;" id="slect-id" class="form-control-sm input">
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                        <option value="03">03</option>
                                                                        <option value="04">04</option>
                                                                        <option value="05">05</option>
                                                                        <option value="06">06</option>
                                                                        <option value="07">07</option>
                                                                        <option value="08">08</option>
                                                                        <option value="09">09</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                    <select name="date_of_death_day" style="border: none;" id="slect-id" class="form-control-sm input">
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                        <option value="03">03</option>
                                                                        <option value="04">04</option>
                                                                        <option value="05">05</option>
                                                                        <option value="06">06</option>
                                                                        <option value="07">07</option>
                                                                        <option value="08">08</option>
                                                                        <option value="09">09</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                        <option value="13">13</option>
                                                                        <option value="14">14</option>
                                                                        <option value="15">15</option>
                                                                        <option value="16">16</option>
                                                                        <option value="17">17</option>
                                                                        <option value="18">18</option>
                                                                        <option value="19">19</option>
                                                                        <option value="20">20</option>
                                                                        <option value="21">21</option>
                                                                        <option value="22">22</option>
                                                                        <option value="23">23</option>
                                                                        <option value="24">24</option>
                                                                        <option value="25">25</option>
                                                                        <option value="26">26</option>
                                                                        <option value="27">27</option>
                                                                        <option value="28">28</option>
                                                                        <option value="29">29</option>
                                                                        <option value="30">30</option>
                                                                        <option value="31">31</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </label>
                                                        <a href="#" id="popover" rel="popover">
                                                            <span class="glyphicon glyphicon-info-sign"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="mb-4 hide-email" id="hide-divs4">
                                                    <div class="form-outline">
                                                        <label for="" class="mb-2">Their email (optional)</label>
                                                        <input type="text" id="input-fields" name="email" placeholder="" class="form-control" style="border-radius: 3px; font-size: medium;" />
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="">
                                                        <strong>Gender:</strong><br>

                                                        <label class="" style="display: inline-flex !important;">
                                                            <input type="radio" name="gender" onclick="hideOptions('female')" class="form-check-label male m-2" id="male" value="m" <?php if ($gender === 'm') echo 'checked'; ?> autocomplete="off"> Male
                                                        </label>
                                                        <label class="" style="display: inline-flex !important;">
                                                            <input type="radio" name="gender" onclick="hideOptions('male')" class="form-check-label female m-2" id="female" value="f" <?php if ($gender === 'f') echo 'checked'; ?> autocomplete="off"> Female
                                                        </label>
                                                        <label class="" style="display: inline-flex !important;">
                                                            <input type="radio" name="gender" class="form-check-label other m-2" id="other" value="o" <?php if ($gender === 'o') echo 'checked'; ?> autocomplete="off"> Other
                                                        </label>
                                                        <br>
                                                        <label class="gender-label py-2" for=""><strong id="she">He</strong> is your:</label>
                                                        <select class="form-select  family" name="my-relation-select" id="select_required" style="border-radius: 3px; font-size: medium; padding:5px;" aria-label="Default select example">
                                                            <option value=""></option>
                                                            <option class="female">mother</option>
                                                            <option class="male">father</option>
                                                            <option class="female">sister</option>
                                                            <option class="male">brother</option>
                                                            <option class="female" id="newTextBoxUp">grandmother</option>
                                                            <option class="male" id="newTextBoxUp">grandfather</option>
                                                            <option class="male female other" id="newTextBoxBoth">cousin</option>
                                                            <option class="female" id="newTextBoxUp">aunt</option>
                                                            <option class="male" id="newTextBoxUp">uncle</option>
                                                            <option class="male">brother-in-law</option>
                                                            <option class="female">daughter</option>
                                                            <option class="female">daughter-in-law</option>
                                                            <option class="male">ex-husband</option>
                                                            <option class="female">ex-wife</option>
                                                            <option class="male">father-in-law</option>
                                                            <option class="female" id="newTextBoxDown">granddaughter</option>
                                                            <option class="male" id="newTextBoxDown">grandson</option>
                                                            <option class="female" id="newTextBoxUp">great aunt</option>
                                                            <option class="female" id="newTextBoxUp">great grand aunt</option>
                                                            <option class="male" id="newTextBoxDown">great grand nephew</option>
                                                            <option class="female" id="newTextBoxDown">great grand niece</option>
                                                            <option class="male" id="newTextBoxUp">great grand uncle</option>
                                                            <option class="male" id="newTextBoxDown">great nephew</option>
                                                            <option class="female" id="newTextBoxDown">great niece</option>
                                                            <option class="male" id="newTextBoxUp">great uncle</option>
                                                            <option class="female" id="newTextBoxDown">great-grand-daughter</option>
                                                            <option class="male" id="newTextBoxUp">great-grandfather</option>
                                                            <option class="female" id="newTextBoxUp">great-grandmother</option>
                                                            <option class="male" id="newTextBoxDown">great-grandson</option>
                                                            <option class="female">great-great-granddaughter</option>
                                                            <option class="male">great-great-grandfather</option>
                                                            <option class="female">great-great-grandmother</option>
                                                            <option class="male">great-great-grandson</option>
                                                            <option class="male">husband</option>
                                                            <option class="female">mother-in-law</option>
                                                            <option class="male" id="newTextBoxDown">nephew</option>
                                                            <option class="female" id="newTextBoxDown">niece</option>
                                                            <option class="male female">significant other</option>
                                                            <option class="female">sister-in-law</option>
                                                            <option class="male">son</option>
                                                            <option class="male">son-in-law</option>
                                                            <option class="female" id="newTextBoxUp">step-aunt</option>
                                                            <option class="male" id="newTextBoxBoth">step-brother</option>
                                                            <option class="male female" id="newTextBoxBoth">step-cousin</option>
                                                            <option class="female">step-daughter</option>
                                                            <option class="male">step-father</option>
                                                            <option class="female" id="newTextBoxDown">step-granddaughter</option>
                                                            <option class="male" id="newTextBoxUp">step-grandfather</option>
                                                            <option class="female" id="newTextBoxUp">step-grandmother</option>
                                                            <option class="male" id="newTextBoxDown">step-grandson</option>
                                                            <option class="female" id="newTextBoxDown">step-great-granddaughter</option>
                                                            <option class="male" id="newTextBoxUp">step-great-grandfather</option>
                                                            <option class="female" id="newTextBoxUp">step-great-grandmother</option>
                                                            <option class="male" id="newTextBoxDown">step-great-grandson</option>
                                                            <option class="female">step-great-great-granddaughter</option>
                                                            <option class="male">step-great-great-grandfather</option>
                                                            <option class="female">step-great-great-grandmother</option>
                                                            <option class="male">step-great-great-grandson</option>
                                                            <option class="female">step-mother</option>
                                                            <option class="male" id="newTextBoxDown">step-nephew</option>
                                                            <option class="female" id="newTextBoxDown">step-niece</option>
                                                            <option class="female" id="newTextBoxBoth">step-sister</option>
                                                            <option class="male">step-son</option>
                                                            <option class="male" id="newTextBoxUp">step-uncle</option>
                                                            <option class="female">wife</option>
                                                            <option class="other">parent</option>
                                                            <option class="other">sibling</option>
                                                            <option class="other" id="newTextBoxUp">grandparent</option>
                                                            <option class="other" id="newTextBoxUp">parents' sibling</option>
                                                            <option class="other">sibling-in-law</option>
                                                            <option class="other">ex-spouse/partner</option>
                                                            <option class="other">parent-in-law</option>
                                                            <option class="other" id="newTextBoxDown">grandchild</option>
                                                            <option class="other" id="newTextBoxDown">siblings great grandchild</option>
                                                            <option class="other" id="newTextBoxUp">great-grandparents sibiling</option>
                                                            <option class="other" id="newTextBoxDown">siblings grandchild</option>
                                                            <option class="other" id="newTextBoxUp">grandparents sibiling</option>
                                                            <option class="other" id="newTextBoxUp">great-grandparent</option>
                                                            <option class="other" id="newTextBoxDown">great-grandchild</option>
                                                            <option class="other">great-great-grandparent</option>
                                                            <option class="other">great-great-grandchild</option>
                                                            <option class="other">spouse/partner</option>
                                                            <option class="other" id="newTextBoxDown">siblings child</option>
                                                            <option class="other">significant other</option>
                                                            <option class="other">child</option>
                                                            <option class="other">child-in-law</option>
                                                            <option class="other" id="newTextBoxBoth">step-sibling</option>
                                                            <option class="other" id="newTextBoxBoth">step-cousin</option>
                                                            <option class="other">step-parent</option>
                                                            <option class="other" id="newTextBoxUp">step-grandparent</option>
                                                            <option class="other" id="newTextBoxDown">step-grandchild</option>
                                                            <option class="other" id="newTextBoxUp">step-great-grandparent</option>
                                                            <option class="other" id="newTextBoxDown">step-great-grandchild</option>
                                                            <option class="other">step-great-great-grandparent</option>
                                                            <option class="other">step-great-great-grandchild</option>
                                                            <option class="other" id="newTextBoxDown">step-siblings child</option>
                                                            <option class="other">step-child</option>
                                                            <option class="other" id="newTextBoxUp">step-parents sibling</option>
                                                        </select>
                                                        <div id="select-error-message" style="color: red;"></div>
                                                        <div id="hide" style="display: none">
                                                            <label class="textUp bothlabel" for="">Parent Side:</label>
                                                            <select class="form-select form-select-sm textUpSelect bothselect" name="parent-side-one" id="" aria-label="Default select example">
                                                                <option value="1">Father's side</option>
                                                                <option value="2">Mother's side</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="">
                                                        <hr>

                                                        <label for="" class="label-2 py-2"><strong>You</strong> are <strong id="his">his</strong>:</label>
                                                        <input type="text" class="form-control  text-new" style="border-radius: 3px; font-size: medium; padding:5px;" name="daughter" value="Daughter" disabled>
                                                        <!-- <select class="form-select data-new" disabled aria-label="Default select example">
                                                                <option value="">daughter</option>
                                                            </select> -->
                                                        <div id="hide1" style="display: none">
                                                            <label class="textDown bothlabel2" for="">Parent Side:</label>
                                                            <select class="form-select form-select-sm textDownSelect bothselect2" id="parent-side-two" name="parent-side-two" aria-label="Default select example">
                                                                <option value="1">Father's side</option>
                                                                <option value="2">Mother's side</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="border-left: 1px solid gray;">
                                                <div class="p-3" id="hide-image">
                                                    <div class="my-divs">
                                                        <h3>Choose Profile Picture</h3>
                                                        <div class="p-4 mb-3" style="border:1px solid gray;  justify-content: center; text-align: center; align-items: center;">
                                                            <span class="fa-solid fa-image p-2"></span>
                                                            <label for="file-upload" class="custom-file-upload text-white" style="background-color: #003B59;">
                                                                <span class="fa-solid fa-image"></span> Choose File
                                                            </label>
                                                            <input id="file-upload" type="file" name="image" />
                                                            <p id="file-name"></p>
                                                        </div>
                                                        <!-- <div class="p-4" style="border:1px solid gray;  justify-content: center; text-align: center; align-items: center;">
                                                            <p class="pt-2">You can create 2 more page with Keeper. Create unlimited pages with Keeper Plus.</p>
                                                            <button style=" background: linear-gradient(113.3deg, rgb(134, 209, 228) -1.8%, rgb(60, 80, 115) 86.4%);">Get Keeper Plus</button>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <?php
                                        if (!isset($_SESSION['family_confermation_message'])) {
                                            ?> <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <button type="submit" name="submit" class="prof-button">Add Family Member</button>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                        ?>
                                    </form>

                                    <div class="hr-div">
                                        <hr>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <a href="/family/<?php echo $username; ?>" class="btn btn-info text-white mt-3" style="background-color:#0099cc;">Return To Family Tree</a>
                                            <!-- <a href="/family/<?php echo $username; ?>" class="btn prof-button" style="background-color:#0099cc;">Return To Family Tree</a> -->
                                            <a href="/cancel_familyrequest.php/<?php echo  $_SESSION['hidden_field_id']; ?>" class="btn btn-danger text-white mt-3 ms-3" style="background-color:#d2322d;">Cancel Request</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex flex-row"><span class="ti-check" style="margin-top: 13px!important;margin-right: 10px!important;"> </span>
                                                <div class="mt-2"><?php echo $_SESSION['family_confermation_message']; ?></div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php
                                    unset($_SESSION['family_confermation_message']);
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            document.getElementById("myForm").addEventListener("submit", function(event) {
                                var inputField = document.getElementById("input-field");
                                var firstNameInput = document.getElementById("first_name");
                                var lastNameInput = document.getElementById("last_name");
                                var select_required = document.getElementById("select_required");
                                var errorMessage = document.getElementById("error-message");
                                var firstNameErrorMessage = document.getElementById("first_name_error");
                                var lastNameErrorMessage = document.getElementById("last_name_error");
                                var selecterrorMessage = document.getElementById("select-error-message");

                                if (inputField.value.trim() === "") {
                                    event.preventDefault();
                                    inputField.style.borderColor = "red";
                                    errorMessage.textContent = "Please enter a name.";
                                } else {
                                    inputField.style.borderColor = ""; // Reset border color if input is not empty
                                    errorMessage.textContent = ""; // Clear error message if input is not empty
                                }
                                // Validate first name
                                if (firstNameInput.value.trim() === "") {
                                    event.preventDefault();
                                    firstNameInput.style.borderColor = "red";
                                    firstNameErrorMessage.textContent = "First name is required.";
                                } else {
                                    firstNameInput.style.borderColor = "";
                                    firstNameErrorMessage.textContent = "";
                                }
                                // Validate last name
                                if (lastNameInput.value.trim() === "") {
                                    event.preventDefault();
                                    lastNameInput.style.borderColor = "red";
                                    lastNameErrorMessage.textContent = "Last name is required.";
                                } else {
                                    lastNameInput.style.borderColor = "";
                                    lastNameErrorMessage.textContent = "";
                                }
                                if (select_required.value.trim() === "") {
                                    event.preventDefault();
                                    select_required.style.borderColor = "red";
                                    selecterrorMessage.textContent = "This field is required.";
                                } else {
                                    lastNameInput.style.borderColor = "";
                                    lastNameErrorMessage.textContent = "";
                                }
                            });
                            document.getElementById("input-field").addEventListener("input", function() {
                                var inputField = document.getElementById("input-field");
                                var errorMessage = document.getElementById("error-message");
                                inputField.style.borderColor = ""; // Reset border color when user starts typing
                                errorMessage.textContent = ""; // Clear error message when user starts typing
                            });
                            document.getElementById("first_name").addEventListener("input", function() {
                                var firstNameInput = document.getElementById("first_name");
                                firstNameInput.style.borderColor = "";
                                document.getElementById("first_name_error").textContent = "";
                            });

                            document.getElementById("last_name").addEventListener("input", function() {
                                var lastNameInput = document.getElementById("last_name");
                                lastNameInput.style.borderColor = "";
                                document.getElementById("last_name_error").textContent = "";
                            });
                            document.getElementById("select_required").addEventListener("change", function() {
                                var selectInput = document.getElementById("select_required");
                                selectInput.style.borderColor = "";
                                document.getElementById("select-error-message").textContent = "";
                            });




                            // Step 1: Retrieve the value of genderInput
                            var genderValue = document.getElementById('genderInput').value;
                            console.log(genderValue);
                            // Step 2: Find the corresponding radio button
                            var radioButtons = document.getElementsByName('gender');
                            var selectedRadioButton;
                            console.log(selectedRadioButton);
                            for (var i = 0; i < radioButtons.length; i++) {
                                if (radioButtons[i].value === genderValue) {
                                    selectedRadioButton = radioButtons[i];
                                    break;
                                }
                            }

                            // Step 3: Set the checked attribute of the radio button
                            if (selectedRadioButton) {
                                selectedRadioButton.checked = true;
                            }

                            // for validation


                            $('.my-divs').hide();

                            $('#show-divs').click(function() {
                                if ($(this).prop('checked')) {
                                    $('.my-divs').slideDown(1000);
                                    $('.hide-email').slideUp(1000);
                                } else {
                                    $('.my-divs').slideUp(1000);
                                    $('.hide-email').slideDown(1000);
                                }
                            });

                            $('#input-field').on('keyup change', function() {
                                if ($(this).val()) {
                                    // $('.self_hide').slideUp(10000);
                                    $('.additional-fields').slideDown(1000);
                                } else {
                                    $('.additional-fields').slideUp(1000);
                                }
                            });

                            var searchTimer = null; // initialize a timer variable

                            $('#input-field').keyup(function() {
                                var query = $(this).val();
                                if (query === '') {
                                    $('#search-results').hide();
                                    return;
                                }

                                if (searchTimer) {
                                    clearTimeout(searchTimer); // clear the previous timer
                                }
                                searchTimer = setTimeout(function() { // set a new timer
                                    if (query.length >= 1) {
                                        $.ajax({
                                            url: '/ajax/search.php',
                                            type: 'POST',
                                            dataType: 'json',
                                            data: {
                                                q: query
                                            },
                                            timeout: 5000, // set a timeout of 5 seconds
                                            beforeSend: function() {
                                                // Show loading icon
                                                $('#input-field').addClass('loading');
                                            },
                                            success: function(response) {
                                                if (response) {

                                                    var output = response.output;
                                                    //var output1 = response.output1;
                                                    // var output2 = response.output2;
                                                    var output4 = response.output4;
                                                    console.log(response);

                                                    // Display the separate response strings on the page
                                                    if (output == '' && output4 == '') {
                                                        $('#search-results').html(output).hide();
                                                        $('#single-input').html(output4).hide();
                                                        $('#hide-divs1').show();
                                                        //$('#error-message').show();

                                                    } else {
                                                        $('#hide-divs1').hide();
                                                        $('#search-results').html(output).show();
                                                        //$('#search-results').show()
                                                        $('#single-input').html(output4).show();
                                                        $('.hidden-input').show();

                                                        console.log(output);


                                                        $('.custom_click').click(function() {
                                                            $('#single-input').remove();

                                                        });
                                                        // $('#input-fields').click(function() {
                                                        //     $('#single-input').remove();
                                                        // });
                                                        $('#slect-id').click(function() {
                                                            $('#single-input').remove();

                                                        });


                                                        $('.input-trigger').click(function(event) {
                                                            event.preventDefault();
                                                            var inputField = $($(this).data('input'));
                                                            var id = inputField.attr('id');
                                                            var gender = $(this).data('gender');
                                                            $('#genderInput').val(gender);

                                                            if (gender == 'male') {
                                                                gender = 'm';
                                                            } else if (gender == 'female') {
                                                                gender = 'f';
                                                            } else {
                                                                gender = 'o';
                                                            }
                                                            console.log('Gender:', gender);
                                                            // Change gender selection
                                                            $('input[name="gender"]').removeAttr('checked'); // Remove checked attribute from all radio buttons
                                                            $('input[name="gender"][value="' + gender + '"]').prop('checked', true); // Set checked attribute for the corresponding radio button
                                                            var firstname = $(this).data('firstname');
                                                            var lastname = $(this).data('lastname');
                                                            var fullname = firstname + ' ' + lastname; // Concatenate firstname and lastname
                                                            console.log('Fullname:', fullname); // Display the concatenated fullname value
                                                            $('#input-field').val(fullname);

                                                            $('.input-field').not(inputField).remove();
                                                            $('#search-results').hide();
                                                            $('.hide-email').remove();
                                                            $('#hide-image').remove();
                                                            $('#hide-divs1').remove();
                                                            $('#hide-divs2').remove();
                                                            $('#hide-divs3').remove();
                                                            $('#hide-name-input').show();
                                                            $('#single-input').hide();
                                                            inputField.toggle();
                                                        });

                                                        // $('.input-trigger').click(function(event) {
                                                        //     event.preventDefault();
                                                        //     var inputField = $($(this).data('input'));
                                                        //     var id = inputField.attr('id');
                                                        //     var gender = $(this).data('gender');
                                                        //     $('#genderInput').val(gender);

                                                        //     // Change gender selection
                                                        //     $('input[name="gender"]').removeAttr('checked'); // Remove checked attribute from all radio buttons
                                                        //     $('input[name="gender"][value="' + gender + '"]').prop('checked', true); // Set checked attribute for the corresponding radio button

                                                        //     console.log('Gender:', gender);
                                                        //     $('.input-field').not(inputField).remove();
                                                        //     $('#search-results').hide();
                                                        //     $('.hide-email').remove();
                                                        //     $('#hide-image').remove();
                                                        //     $('#hide-divs1').remove();
                                                        //     $('#hide-divs2').remove();
                                                        //     $('#hide-divs3').remove();
                                                        //     $('#hide-name-input').show();
                                                        //     $('#single-input').hide();
                                                        //     inputField.toggle();
                                                        // });

                                                    }

                                                } else {
                                                    // If there are no results, hide any previous results and show an error messag
                                                    $('#search-results').show();
                                                    if ($('#input-fields').is(':focus')) {
                                                        $('#hide-name-input').hide();
                                                        //$('#hide-divs1').show();

                                                    } else {
                                                        $('#hide-name-input').show();
                                                    }
                                                    if ($('#first_name').is(':focus')) {
                                                        $('#hide-name-input').hide();
                                                        //$('#hide-divs1').show();

                                                    } else {
                                                        $('#hide-name-input').show();
                                                    }
                                                    if ($('#last_name').is(':focus')) {
                                                        $('#hide-name-input').hide();
                                                        //$('#hide-divs1').show();

                                                    } else {
                                                        $('#hide-name-input').show();
                                                    }
                                                }
                                            },
                                            complete: function() {
                                                // Hide loading icon
                                                $('#input-field').removeClass('loading');
                                            },
                                        });
                                    } else {
                                        $('#search-results').html('');
                                    }
                                }, 30); // set a delay of 500 milliseconds before sending the request
                            });

                            $('#input-fields').on('focus', function() {
                                $('#hide-name-input').hide();
                                $('#hide-divs1').show();
                            });
                            $('#first_name').on('focus', function() {
                                $('#hide-name-input').hide();
                                $('#hide-divs1').show();
                            });
                            $('#last_name').on('focus', function() {
                                $('#hide-name-input').hide();
                                $('#hide-divs1').show();
                            });


                            $(document).on("click", "#hide-inputs", function(event) {
                                event.preventDefault();
                                $("#hide-divs1, #hide-divs2, #hide-divs3, #hide-divs4, #search-results, #hide-image, #hide-name-input").hide();
                                //$('#output1-container').show();
                                console.log('clicked');

                            });



                            // for image
                            const input = document.querySelector('input[type="file"]');
                            const fileName = document.getElementById('file-name');

                            input.addEventListener('change', () => {
                                const file = input.files[0];
                                if (file) {
                                    fileName.textContent = file.name;
                                }
                            });


                            // -------------------------------------------------------------------------//


                            // //for gender feilds all functionality

                            const maleRadio = document.querySelector('.male');

                            // Add an event listener to the male radio button to listen for changes
                            maleRadio.addEventListener('change', function() {
                                // Get all options with class "male"
                                const allOptions = document.querySelectorAll('.family option');

                                // Loop through each option and show or hide it based on whether the radio button is checked or not
                                allOptions.forEach(function(option) {
                                    if (option.classList.contains('male')) {
                                        if (maleRadio.checked) {
                                            option.style.display = 'block';
                                        } else {
                                            option.style.display = 'none';
                                        }
                                    } else {
                                        if (maleRadio.checked) {
                                            option.checked = false;
                                            option.style.display = 'none';
                                        } else {
                                            option.style.display = 'none';
                                        }
                                    }
                                });
                            });


                            // Show options with class "male" and select the first option
                            if (maleRadio.checked) {
                                const maleOptions = document.querySelectorAll('.male');
                                let maleIndex = 0; // Initialize index for male options

                                maleOptions.forEach(function(option, index) {
                                    option.style.display = 'block';
                                    if (option.classList.contains('male')) {
                                        if (maleIndex === 0) {
                                            option.selected = true;
                                        }
                                        maleIndex++;
                                    }
                                });

                                const otherOptions = document.querySelectorAll('.family option:not(.male)');
                                otherOptions.forEach(function(option) {
                                    option.checked = false;
                                    option.style.display = 'none';
                                });
                            }
                            // Get the radio button with class "female"
                            const femaleRadio = document.querySelector('.female');

                            // Add an event listener to the female radio button to listen for changes
                            femaleRadio.addEventListener('change', function() {
                                // Get all options with class "female"
                                const allOptions = document.querySelectorAll('.family option');
is
                                // Loop through each option and show or hide it based on whether the radio button is checked or not
                                allOptions.forEach(function(option, index) {
                                    if (option.classList.contains('female')) {
                                        if (femaleRadio.checked) {
                                            option.style.display = 'block';
                                            if (index === 0) {
                                                option.selected = true;
                                            }
                                        } else {
                                            option.style.display = 'none';
                                        }
                                    } else {
                                        option.style.display = 'none';
                                    }
                                });
                            });

                            // Show options with class "female" and select the first option if the radio button is already checked
                            if (femaleRadio.checked) {
                                const femaleOptions = document.querySelectorAll('.female');
                                let femaleIndex = 0; // Initialize index for male options

                                femaleOptions.forEach(function(option, index) {
                                    option.style.display = 'block';
                                    if (femaleIndex === 0) {
                                        option.selected = true;
                                    }
                                    femaleIndex++;
                                });

                                const otherOptions = document.querySelectorAll('.family option:not(.female)');
                                otherOptions.forEach(function(option) {
                                    option.checked = false;
                                    option.style.display = 'none';
                                });
                            }


                            // Get the radio button with class "other"
                            const otherRadio = document.querySelector('.other');

                            // Add an event listener to the other radio button to listen for changes
                            otherRadio.addEventListener('change', function() {
                                // Get all options with class "other"
                                const allOptions = document.querySelectorAll('.family option');

                                // Loop through each option and show or hide it based on whether the radio button is checked or not
                                allOptions.forEach(function(option, index) {
                                    if (option.classList.contains('other')) {
                                        if (otherRadio.checked) {
                                            option.style.display = 'block';
                                            if (index === 0) {
                                                option.selected = true;
                                            }
                                        } else {
                                            option.style.display = 'none';
                                        }
                                    } else {
                                        option.style.display = 'none';
                                    }
                                });
                            });


                            const genderLabel = document.querySelector('.gender-label');
                            const label2 = document.querySelector('.label-2');

                            // Add an event listener to all radio buttons to listen for changes
                            const allRadioButtons = document.querySelectorAll('input[type="radio"]');
                            allRadioButtons.forEach(function(radioButton) {
                                radioButton.addEventListener('change', function() {
                                    // Get the value of the selected radio button
                                    const selectedGender = document.querySelector('input[name="gender"]:checked').value;

                                    // Update the labels based on the selected gender
                                    if (selectedGender === 'm') {
                                        genderLabel.innerHTML = '<strong>He</strong> is your:';
                                        label2.innerHTML = '<strong>You</strong> are <strong>his</strong>:';
                                    } else if (selectedGender === 'f') {
                                        genderLabel.innerHTML = '<strong>She</strong> is your:';
                                        label2.innerHTML = '<strong>You</strong> are <strong>her</strong>:';
                                    } else if (selectedGender === 'o') {
                                        genderLabel.innerHTML = '<strong>They</strong> are your:';
                                        label2.innerHTML = '<strong>You</strois yourng> are <strong>theirs</strong>:';
                                    }
                                });
                            });
                            const textBox = document.querySelector('.family');
                            const labelUp = document.querySelector('.textUp');
                            const selectBoxUp = document.querySelector('.textUpSelect');
                            const labelDown = document.querySelector('.textDown');
                            const selectBoxDown = document.querySelector('.textDownSelect');
                            const labelBoth = document.querySelector('.bothlabel');
                            const selectBoxBoth1 = document.querySelector('.bothselect');
                            const labelBoth2 = document.querySelector('.bothlabel2');
                            const selectBoxBoth2 = document.querySelector('.bothselect2');

                            // Hide all labels and select boxes initially
                            labelUp.style.display = 'none';
                            selectBoxUp.style.display = 'none';
                            labelDown.style.display = 'none';
                            selectBoxDown.style.display = 'none';
                            labelBoth.style.display = 'none';
                            selectBoxBoth1.style.display = 'none';
                            labelBoth2.style.display = 'none';
                            selectBoxBoth2.style.display = 'none';

                            // Add event listener to the select box to check for changes
                            textBox.addEventListener('change', function(event) {
                                // Get the selected option's ID
                                const selectedOptionId = this.options[this.selectedIndex].id;
                                console.log(selectedOptionId);

                                switch (selectedOptionId) {
                                    case 'newTextBoxUp':
                                        // Display the label and select box for textUp
                                        labelUp.style.display = 'inline-block';
                                        selectBoxUp.style.display = 'inline-block';
                                        labelDown.style.display = 'none';
                                        selectBoxDown.style.display = 'none';
                                        break;
                                    case 'newTextBoxDown':
                                        // Display the label and select box for textDown
                                        labelUp.style.display = 'none';
                                        selectBoxUp.style.display = 'none';
                                        labelDown.style.display = 'inline-block';
                                        selectBoxDown.style.display = 'inline-block';
                                        break;
                                    case 'newTextBoxBoth':
                                        // Display both labels and select boxes for both
                                        labelBoth.style.display = 'inline-block';
                                        selectBoxBoth1.style.display = 'inline-block';
                                        labelBoth2.style.display = 'inline-block';
                                        selectBoxBoth2.style.display = 'inline-block';
                                        break;
                                    default:
                                        // Hide all labels and select boxes
                                        labelUp.style.display = 'none';
                                        selectBoxUp.style.display = 'none';
                                        labelDown.style.display = 'none';
                                        selectBoxDown.style.display = 'none';
                                        labelBoth.style.display = 'none';
                                        selectBoxBoth1.style.display = 'none';
                                        labelBoth2.style.display = 'none';
                                        selectBoxBoth2.style.display = 'none';
                                        break;
                                }
                            });



                            const familySelect = document.querySelector('.family');
                            const textNewInput = document.querySelector('.text-new');

                            familySelect.addEventListener('change', function() {
                                switch (this.value) {
                                    case 'mother':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'daughter';
                                        break;
                                    case 'father':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'son';
                                        break;
                                    case 'brother':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'sister';
                                        break;
                                    case 'sister':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'sister';
                                        break;
                                    case 'grandmother':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'granddaughter';
                                        break;
                                    case 'grandfather':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'granddaughter';
                                        break;
                                    case 'cousin':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'cousin';
                                        break;
                                    case 'aunt':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'niece';
                                        break;
                                    case 'uncle':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'niece';
                                        break;
                                    case 'brother-in-law':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'sister-in-law';
                                        break;
                                    case 'daughter':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'mother';
                                        break;
                                    case 'daughter-in-law':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'mother-in-law';
                                        break;
                                    case 'ex-husband':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'ex-wife';
                                        break;
                                    case 'ex-wife':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'ex-wife';
                                        break;
                                    case 'father-in-law':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'daughter-in-law';
                                        break;
                                    case 'granddaughter':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'grandmother';
                                        break;
                                    case 'grandson':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'grandmother';
                                        break;
                                    case 'great aunt':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great niece';
                                        break;
                                    case 'great grand aunt':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great grand nephew';
                                        // check??

                                        break;
                                    case 'great grand nephew':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great grand aunt';
                                        break;
                                    case 'great grand niece':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great grand aunt';
                                        break;
                                    case 'great grand uncle':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great grand niece';
                                        break;
                                    case 'great nephew':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great aunt';
                                        break;
                                    case 'great niece':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great aunt';
                                        break;
                                    case 'great uncle':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great niece';
                                        break;
                                    case 'great-grand-daughter':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great-grand-mother';
                                        break;
                                    case 'great-grandfather':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great-grand-daughter';
                                        break;
                                    case 'great-grandmother':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great-grand-daughter';
                                        break;
                                    case 'great-grandson':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great-grandmother';
                                        break;
                                    case 'great-great-granddaughter':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great-great-grandmother';
                                        break;
                                    case 'great-great-grandfather':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great-great-granddaughter';
                                        break;
                                    case 'great-great-grandmother':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great-great-granddaughter';
                                        break;
                                    case 'great-great-grandson':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great-great-grandmother';
                                        break;
                                    case 'husband':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'wife';
                                        break;
                                    case 'mother-in-law':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'daughter-in-law';
                                        break;
                                    case 'nephew':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'aunt';
                                        break;
                                    case 'niece':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'aunt';
                                        break;
                                    case 'significant other':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'significant other';
                                        break;
                                    case 'sister-in-law':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'sister-in-law';
                                        break;
                                    case 'son':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'mother';
                                        break;
                                    case 'son-in-law':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'mother-in-law';
                                        break;
                                    case 'step-aunt':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-niece';
                                        break;
                                    case 'step-brother':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-sister';
                                        break;
                                    case 'step-cousin':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-cousin';
                                        break;
                                    case 'step-daughter':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-mother';
                                        break;
                                    case 'step-father':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-daughter';
                                        break;
                                    case 'step-granddaughter':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-grandmother';
                                        break;
                                    case 'step-grandfather':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-granddaughter';
                                        break;
                                    case 'step-grandmother':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-granddaughter';
                                        break;
                                    case 'step-grandson':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-grandmother';
                                        break;
                                    case 'step-great-granddaughter':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-great-grandmother';
                                        break;
                                    case 'step-great-grandfather':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-great-granddaughter';
                                        break;
                                    case 'step-great-grandmother':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-great-granddaughter';
                                        break;
                                    case 'step-great-grandson':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-great-grandmother';
                                        break;
                                    case 'step-great-great-granddaughter':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-great-great-grandmother';
                                        break;
                                    case 'step-great-great-grandfather':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-great-great-granddaughter';
                                        break;
                                    case 'step-great-great-grandmother':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-great-great-granddaughter';
                                        break;
                                    case 'step-great-great-grandson':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-great-great-grandmother';
                                        break;
                                    case 'step-mother':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-daughter';
                                        break;
                                    case 'step-nephew':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-aunt';
                                        break;
                                    case 'step-niece':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-aunt';
                                        break;
                                    case 'step-sister':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-sister';
                                        break;
                                    case 'step-son':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-mother';
                                        break;
                                    case 'step-uncle':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-niece';
                                        break;
                                    case 'wife':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'wife';
                                        break;
                                    case 'parent':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'daughter';
                                        break;
                                    case 'sibling':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'sister';
                                        break;
                                    case 'grandparent':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'granddaughter';
                                        break;
                                    case 'parent’s sibling':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'niece';
                                        break;
                                    case 'sibling-in-law':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'sister-in-law';
                                        break;
                                    case 'ex-spouse/partner':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'ex-wife';
                                        break;
                                    case 'parent-in-law':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'daughter-in-law';
                                        break;
                                    case 'grandchild':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'grandmother';
                                        break;
                                    case 'sibling’s great grandchild':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great grand aunt';
                                        break;
                                    case 'great-grandparent’s sibiling':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great grand niece';
                                        break;
                                    case 'sibling’s grandchild':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great aunt';
                                        break;
                                    case 'grandparent’s sibiling':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great niece';
                                        break;
                                    case 'great-grandparent':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great-grand-daughter';
                                        break;
                                    case 'great-grandchild':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great-grand-mother';
                                        break;
                                    case 'great-great-grandparent':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great-great-granddaughter';
                                        break;
                                    case 'great-great-grandchild':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'great-great-grandmother';
                                        break;
                                    case 'spouse/partner':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'wife';
                                        break;
                                    case 'siblings child':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'aunt';
                                        break;
                                    case 'significant other':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'significant other';
                                        break;
                                    case 'child':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'mother';
                                        break;
                                    case 'child-in-law':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'mother-in-law';
                                        break;
                                    case 'step-sibling':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-sister';
                                        break;
                                    case 'step-cousin':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-cousin';
                                        break;
                                    case 'step-parent':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-daughter';
                                        break;
                                    case 'step-grandparent':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-granddaughter';
                                        break;
                                    case 'step-grandchild':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-grandmother';
                                        break;
                                    case 'step-great-grandparent':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-great-granddaughter';
                                        break;
                                    case 'step-great-grandchild':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-great-grandmother';
                                        break;
                                    case 'step-great-great-grandparent':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-great-great-granddaughter';
                                        break;
                                    case 'step-great-great-grandchild':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-great-great-grandmother';
                                        break;
                                    case 'step-siblings child':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-aunt';
                                        break;
                                    case 'step-child':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-mother';
                                        break;
                                    case 'step-parents sibling':
                                        textNewInput.disabled = true;
                                        textNewInput.value = 'step-niece';
                                        break;
                                    default:
                                        textNewInput.disabled = true;
                                        textNewInput.value = '';
                                }
                            });


                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script>
    $(".alert").delay(5000).slideUp(1000, function() {
        $(this).alert('close');
    });

    $(".custom_alert").delay(15000).slideUp(2000, function() {
        $(this).alert('close');
    });
</script>

<script>
 const input = document.getElementById('select_required');
 const hide = document.getElementById('hide');
 const hide1 = document.getElementById('hide1');
//  if(localStorage.getItem('member_name') === "mother") {
//      input.value = "mother";
//  }else if (localStorage.getItem('member_name') === "father") {
//      input.value = "father";
//  }else if (localStorage.getItem('member_name') === "grand_mother") {
//      input.value = "grandmother";
//      hide.style.display="block"
//  }else if (localStorage.getItem('member_name') === "grand_father") {
//      input.value = "grandfather";
//      hide.style.display="block";
//  }

if(localStorage.getItem('member_name') === "grand_mother"){
    document.getElementById('she').textContent = "She";
    document.getElementById('his').textContent = "her";
}else if (localStorage.getItem('member_name') === "mother") {
    document.getElementById('she').textContent = "She";
    document.getElementById('his').textContent = "her";
}

 input.addEventListener("change", function() {

     if(input.value === "cousin") {
         hide1.style.display = "block";
         hide.style.display = "block";
     } else if(input.value === "grandfather") {
         hide.style.display = "block";
     } else if(input.value === "uncle") {
         hide.style.display = "block";
     }else if(input.value === "great grand uncle") {
         hide.style.display = "block";
     }else if(input.value === "great nephew") {
         hide1.style.display = "block";
     }else if(input.value === "great uncle") {
         hide.style.display = "block";
     }else if(input.value === "great-grandfather") {
         hide.style.display = "block";
     }else if(input.value === "great-grandson") {
         hide1.style.display = "block";
     }else if(input.value === "step-uncle") {
         hide.style.display = "block";
     }else if(input.value === "step-nephew") {
         hide1.style.display = "block";
     }else if(input.value === "grandmother") {
         hide.style.display = "block";
     }else if(input.value === "aunt") {
         hide.style.display = "block";
     }else if(input.value === "granddaughter") {
         hide1.style.display = "block";
     }else if(input.value === "great aunt") {
         hide.style.display = "block";
     }else if(input.value === "great grand aunt") {
         hide.style.display = "block";
     }else if(input.value === "great grand niece") {
         hide1.style.display = "block";
     }else if(input.value === "great niece") {
         hide1.style.display = "block";
     }else if(input.value === "great-grand-daughter") {
         hide.style.display = "block";
     }else if(input.value === "great-grandmother") {
         hide.style.display = "block";
     }else if(input.value === "niece") {
         hide1.style.display = "block";
     }else if(input.value === "step-aunt") {
         hide.style.display = "block";
     }else if(input.value === "step-cousin") {
         hide.style.display = "block";
         hide1.style.display = "block";
     }else if(input.value === "step-grandmother") {
         hide.style.display = "block";
     }else if(input.value === "step-great-granddaughter") {
         hide1.style.display = "block";
     }else if(input.value === "step-niece") {
         hide1.style.display = "block";
     } else {
         hide.style.display = "none";
         hide1.style.display = "none";
     }
 });


 function hideOptions(class_name) {
     var selectElement = document.getElementById("select_required");
     var options = selectElement.getElementsByTagName("option");

     for (var i = 0; i < options.length; i++) {
         var option = options[i];
         if (option.classList.contains(class_name)) {
             option.style.display = "none";
         } else {
             option.style.display = "block";
         }
     }
 }
</script>
<?php
    
	require_once $_SERVER['DOCUMENT_ROOT'] . '/requires/footer.php';

?>
</body>
</html>