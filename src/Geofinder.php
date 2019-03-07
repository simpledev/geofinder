<?php

namespace Simpledev\Geofinder;

class Geofinder
{
    public function getCoords($file = null)
    {
        if (getimagesize($file) && getimagesize($file)['mime'] == 'image/jpeg') {
            $exif = exif_read_data($file, 0, true);
            if ($exif && ! empty($exif['GPS'])) {
                if (! empty($exif['GPS']['GPSLatitudeRef']) && ! empty($exif['GPS']['GPSLatitude']) && ! empty($exif['GPS']['GPSLongitudeRef'] && ! empty($exif['GPS']['GPSLongitude']))) {
                    $GPSLatitudeRef = $exif['GPS']['GPSLatitudeRef'];
                    $GPSLatitude = $exif['GPS']['GPSLatitude'];
                    $GPSLongitudeRef = $exif['GPS']['GPSLongitudeRef'];
                    $GPSLongitude = $exif['GPS']['GPSLongitude'];

                    $lat_degrees = count($GPSLatitude) > 0 ? $this->gps2Num($GPSLatitude[0]) : 0;
                    $lat_minutes = count($GPSLatitude) > 1 ? $this->gps2Num($GPSLatitude[1]) : 0;
                    $lat_seconds = count($GPSLatitude) > 2 ? $this->gps2Num($GPSLatitude[2]) : 0;

                    $lon_degrees = count($GPSLongitude) > 0 ? $this->gps2Num($GPSLongitude[0]) : 0;
                    $lon_minutes = count($GPSLongitude) > 1 ? $this->gps2Num($GPSLongitude[1]) : 0;
                    $lon_seconds = count($GPSLongitude) > 2 ? $this->gps2Num($GPSLongitude[2]) : 0;

                    $lat_direction = ($GPSLatitudeRef == 'W' or $GPSLatitudeRef == 'S') ? -1 : 1;
                    $lon_direction = ($GPSLongitudeRef == 'W' or $GPSLongitudeRef == 'S') ? -1 : 1;

                    $latitude = $lat_direction * ($lat_degrees + ($lat_minutes / 60) + ($lat_seconds / (60 * 60)));
                    $longitude = $lon_direction * ($lon_degrees + ($lon_minutes / 60) + ($lon_seconds / (60 * 60)));

                    return ['latitude'=>$latitude, 'longitude'=>$longitude];
                }

                return false;
            }

            return false;
        }

        return false;
    }

    private function gps2Num($coordPart)
    {
        $parts = explode('/', $coordPart);
        if (count($parts) <= 0) {
            return 0;
        }
        if (count($parts) == 1) {
            return $parts[0];
        }

        return floatval($parts[0]) / floatval($parts[1]);
    }
}
