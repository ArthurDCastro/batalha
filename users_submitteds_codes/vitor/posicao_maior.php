<?php

function posicao_maior ($vet) {

	for ($i = 0; $i < count($vet); $i++) {

		if ($i != 0) {
			if ($vet[$i] < $vet[$i - 1]) {

				return $i - 1;

			}

		}

	}

}