<div class="col-md-3">

						

							<div style="margin-bottom: 1rem">
								<div style="display:flex; justify-content: space-between; align-items: center">
									<span style="font-size:20px">
										Filtrar por precio
									</span>

									<a onClick="resetPrice()" style="font-size:12px; cursor:pointer">Limpiar precio</a>
								</div>

								<div style="padding:1rem">
									<div style="display: flex; flex-direction:column; gap:0.4rem">

										<button class="btn_1" style="background-color:#FFC107; color: #222" onclick="filterPrice('<50')">
											Bajo 50$
										</button>

										<button class="btn_1" style="background-color:#FFC107; color: #222" onclick="filterPrice('50-100')">
											50$ - 100$
										</button>

										<button class="btn_1" style="background-color:#FFC107; color: #222" onclick="filterPrice('100-300')">
											100$ - 300$
										</button>

										<button class="btn_1" style="background-color:#FFC107; color: #222" onclick="filterPrice('300-1000')">
											300$ - 1000$
										</button>

									</div>
								</div>
							</div>

							<div style="margin-bottom: 1rem">
								<div style="display:flex; justify-content: space-between; align-items: center">
									<span style="font-size:20px">
										Color
									</span>

									<a onClick="resetColor()" style="font-size:12px; cursor:pointer">Limpiar color</a>
								</div>

								<div style="padding:1rem">
									<div style="display: flex; flex-direction:column; gap:0.4rem">

										<?php

										$sql_ = mysqli_query($link, "select * from color where estatus='si'");

										while ($row = mysqli_fetch_assoc($sql_)) {
										?>

											<a style='cursor:pointer' onClick='filterColor(<?= $row['id'] ?>, "<?= $row['nombre_es'] ?>")'>- <?= $row['nombre_es'] ?></a>

										<?php } ?>

									</div>
								</div>
							</div>


							<div style="margin-bottom: 1rem">
								<div style="display:flex; justify-content: space-between; align-items: center">
									<span style="font-size:20px">
										Fabricante
									</span>

									<a onClick="resetFabricante()" style="font-size:12px; cursor:pointer">Limpiar fabricante</a>
								</div>

								<div style="padding:1rem">
									<div style="display: flex; flex-direction:column; gap:0.4rem">

										<?php

										$sql_ = mysqli_query($link, "select * from marcas where estatus='si'");

										while ($row = mysqli_fetch_assoc($sql_)) { ?>

											<a style='cursor:pointer' onClick='filterFabricante(<?= $row['id'] ?>,"<?= $row['nombre_es'] ?>")'>- <?= $row['nombre_es'] ?></a>

										<?php } ?>

									</div>
								</div>
							</div>

							<div style="margin-bottom: 1rem">
								<div style="display:flex; justify-content: space-between; align-items: center">
									<span style="font-size:20px">
										Categor&iacute;a
									</span>

									<a onClick="resetCategoria()" style="font-size:12px; cursor:pointer">Limpiar Categor&iacute;a</a>
								</div>

								<div style="padding:1rem">
									<div style="display: flex; flex-direction:column; gap:0.4rem">

										<?php

										$sql_ = mysqli_query($link, "select * from categorias where estatus='si'");

										while ($row = mysqli_fetch_assoc($sql_)) { ?>

											<a style='cursor:pointer' onClick='filterCategoria(<?= $row['id'] ?>, "<?= $row['nombre_es'] ?>")'>- <?= $row['nombre_es'] ?></a>


										<?php } ?>

									</div>
								</div>
							</div>

						</div>