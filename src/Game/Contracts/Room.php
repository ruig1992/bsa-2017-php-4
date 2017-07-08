<?php

namespace BinaryStudioAcademy\Game\Contracts;

interface Room
{
    public function addAvailableRoom(Room $room): self;
    public function getAvailableRoom(string $name): self;
    public function addThing(Thing $thing): self;
    public function takeThing(string $name): Thing;
    public function getAvailableRooms(bool $isArray = false);
    public function getThings(string $name = '');
    public function getThingsCount(string $name = '');
}
