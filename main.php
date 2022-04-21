<?php
include('assets/header.html');
include('assets/side.html');

include('bmi.php');
include('pasien.php');
include('bmipasien.php');

$patient1 = new Patient(1, 'P001', 'Ahmad', 'makassar', '2011/5/3', 'jannahpro@gmail.com', 'L');
$bmi1 = new BMI(69.8, 169);
$bmiPatient1 = new BMIPatient(1, $bmi1, date("Y-m-d"), $patient1);

$patient2 = new Patient(2, 'P002', 'Rina', 'soklandia', '2015/6/1', 'bulgaMax@gmail.com', 'P');
$bmi2 = new BMI(55.3, 165);
$bmiPatient2 = new BMIPatient(2, $bmi2, date("Y-m-d"), $patient2);

$patient3 = new Patient(3, 'P003', 'Lutfi', 'Gotham City', '1992/6/1', 'maduralite@gmail.com', 'L');
$bmi3 = new BMI(45.2, 171);
$bmiPatient3 = new BMIPatient(3, $bmi3, date("Y-m-d"), $patient3);

$listBmiPatient = array($bmiPatient1, $bmiPatient2, $bmiPatient3);

if (isset($_POST['name'])) {
    $name = $_POST['name'] ?? '';
    $placeOfBirth = $_POST['placeOfBirth'] ?? '';
    $dateOfBirth = $_POST['dateOfBirth'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $height = $_POST['height'] ?? '';
    $weight = $_POST['weight'] ?? '';
    $email = $_POST['email'] ?? '';

    $patientInput = new Patient(4, 'P004', $name, $placeOfBirth, $dateOfBirth, $email, $gender);
    $bmiInput = new BMI($weight, $height);
    $bmiPatientInput = new BMIPatient(4, $bmiInput, date("Y-m-d"), $patientInput);

    array_push($listBmiPatient, $bmiPatientInput);
}
?>

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-12">
                <h1 style="text-align: center;"><b>BODY MASS INDEX CALCULATOR</b></h1>
                <hr>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Calculator -->
                <div class="card">
                    <div class="card-body">
                        <!-- form start -->
                        <form action="main.php" method="post" class="form-horizontal">
                            <div class="justify-content-center form-group row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" required name="name" class="form-control" placeholder="Nama Anda">
                                </div>
                            </div>
                            <div class="justify-content-center form-group row">
                                <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" required name="placeOfBirth" class="form-control" placeholder="Kota kelahiran">
                                </div>
                            </div>
                            <div class="justify-content-center form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="date" required name="dateOfBirth" class="form-control">
                                </div>
                            </div>
                            <div class="justify-content-center form-group row">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div style="margin-top: 0.5%;" class="col-sm-9">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="pria" name="gender" value="L">
                                        <label class="align-bottom font-weight-normal" for="pria">Pria</label>
                                    </div>
                                    <div style="margin-left: 1%;" class="icheck-primary d-inline">
                                        <input type="radio" id="wanita" name="gender" value="P">
                                        <label class="align-bottom font-weight-normal" for="wanita">Wanita</label>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-center form-group row">
                                <label class="col-sm-2 col-form-label">Tinggi Badan</label>
                                <div class="col-sm-9">
                                    <input type="number" required name="height" class="form-control" placeholder="Berapa tinggi Anda? (cm)">
                                </div>
                            </div>
                            <div class="justify-content-center form-group row">
                                <label class="col-sm-2 col-form-label">Berat Badan</label>
                                <div class="col-sm-9">
                                    <input type="number" required name="weight" class="form-control" placeholder="Berapa berat badan Anda? (kg)">
                                </div>
                            </div>
                            <div class="justify-content-center form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" required name="email" class="form-control" placeholder="Email Anda">
                                </div>
                            </div>
                            <div class="justify-content-center d-flex flex-row-reverse">
                                <button type="submit" class="col-sm-11 btn btn-primary btn-block">Hitung</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Parameter -->
                <div class="card">
                    <div class="card-body">
                    <?php if (isset($_POST['name'])) {
                            $gender_type = '';

                            if ($patientInput->gender == "P") {
                                $gender_type = 'cwe';
                            } elseif ($patientInput->gender == "L") {
                                $gender_type = 'cwo';
                            }

                            $opa1 = 0.2;
                            $opa2 = 0.2;
                            $opa3 = 0.2;
                            $opa4 = 0.2;
                            $opa5 = 0.2;

                            $mass = $bmiInput->ValueBMI();

                            if ($mass >= 30.0) {
                                $opa5 = 1;
                            } elseif ($mass >= 27.0 && $mass <= 29.9) {
                                $opa4 = 1;
                            } elseif ($mass >= 24.0 && $mass <= 26.9) {
                                $opa3 = 1;
                            } elseif ($mass >= 18.5 && $mass <= 23.9) {
                                $opa2 = 1;
                            } elseif ($mass <= 18.4) {
                                $opa1 = 1;
                            }
                        ?>
                        <center>
                        <div class="container">
                            <h3 class="font-weight-bold mb-3">BMI Anda Adalah <?= $bmiInput->ValueBMI() ?></h3>
                            <hr>
                            <br>
                                <div class="row">
                                    <div class="col-sm">
                                        <img src="dist/img/<?= $gender_type ?>1.svg" class="img-fluid mb-3" style="max-width: 80%; height: 75%;opacity: <?= $opa1 ?>;">
                                        <h6 class="font-weight-bold text-center"> Kekurangan Bobot </h6>
                                        <h6 class=" text-center"> < 18.5 </h6>
                                    </div>
                                    <div class="col-sm">
                                        <img src="dist/img/<?= $gender_type ?>2.svg" class="img-fluid mb-3" style="max-width: 80%; height: 75%;opacity: <?= $opa2 ?>;">
                                        <h6 class="font-weight-bold text-center"> Sehat </h6>
                                        <h6 class=" text-center"> 18.5 - 23.9 </h6>
                                    </div>
                                    <div class="col-sm">
                                        <img src="dist/img/<?= $gender_type ?>3.svg" class="img-fluid mb-3" style="max-width: 80%; height: 75%;opacity: <?= $opa3 ?>;">
                                        <h6 class="font-weight-bold text-center"> Kelebihan Bobot</h6>
                                        <h6 class=" text-center"> 24 - 26.9</h6>
                                    </div>
                                    <div class="col-sm">
                                        <img src="dist/img/<?= $gender_type ?>4.svg" class="img-fluid  mb-3" style="max-width: 80%; height: 75%;opacity: <?= $opa4 ?>;">
                                        <h6 class="font-weight-bold text-center"> Obesitas 1</h6>
                                        <h6 class=" text-center"> 27 - 29.9 </h6>
                                    </div>
                                    <div class="col-sm">
                                        <img src="dist/img/<?= $gender_type ?>5.svg" class="img-fluid mb-3" style="max-width: 80%; height: 75%;opacity: <?= $opa5 ?>;">
                                        <h6 class="font-weight-bold text-center"> Obesitas 2 </h6>
                                        <h6 class=" text-center"> 30 < </h6>
                                    </div>
                                </div>
                        </div>
                        </center>
                        <?php } ?>
                    </div>
                </div>
                <!-- Table -->
                <div class="card">
                    <div class="card-body table-responsive">
                    <h3 class="text-center font-weight-bold mb-3">Tabel BMI Pasien</h3>
                    <hr>
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Periksa</th>
                                    <th>Kode Pasien</th>
                                    <th>Nama Pasien</th>
                                    <th>Gender</th>
                                    <th>Tinggi (cm)</th>
                                    <th>Berat (kg)</th>
                                    <th>Nilai BMI</th>
                                    <th>Status BMI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    for ($i = 0; $i < count($listBmiPatient); $i++) {
                                        echo '<tr>';
                                        echo '<td>' . $listBmiPatient[$i]->id . '</td>';
                                        echo '<td>' . $listBmiPatient[$i]->date . '</td>';
                                        echo '<td>' . $listBmiPatient[$i]->patient->code . '</td>';
                                        echo '<td>' . $listBmiPatient[$i]->patient->name . '</td>';
                                        echo '<td>' . $listBmiPatient[$i]->patient->gender . '</td>';
                                        echo '<td>' . $listBmiPatient[$i]->bmi->height . '</td>';
                                        echo '<td>' . $listBmiPatient[$i]->bmi->weight . '</td>';
                                        echo '<td>' . $listBmiPatient[$i]->bmi->ValueBMI() . '</td>';
                                        echo '<td>' . $listBmiPatient[$i]->bmi->StatusBMI($listBmiPatient[$i]->bmi->ValueBMI()) . '</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
<!-- /.content-wrapper -->

<?php
include('assets/footer.html');
?>