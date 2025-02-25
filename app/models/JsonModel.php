<?php

class JsonModel {
    private $jsonFile = __DIR__ . "/../../storage/data.json";

    public function getData() {
        if (!file_exists($this->jsonFile)) {
            return ["error" => "Файл данных не найден"];
        }

        $jsonData = file_get_contents($this->jsonFile);
        return json_decode($jsonData, true);
    }

    public function saveData($data) {
        file_put_contents($this->jsonFile, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}
