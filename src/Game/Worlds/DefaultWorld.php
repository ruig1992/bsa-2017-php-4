<?php

namespace BinaryStudioAcademy\Game\Worlds;

use BinaryStudioAcademy\Game\Contracts\Player;
use BinaryStudioAcademy\Game\Contracts\GameWorld;

use BinaryStudioAcademy\Game\Players\DefaultPlayer;

use BinaryStudioAcademy\Game\Factories\RoomFactory;
use BinaryStudioAcademy\Game\Factories\ThingFactory;


class DefaultWorld extends AbstractWorld
{
    /**
     * Make the Player with the Room as his starting position in the Game
     * @return Player
     */
    public function makePlayer(): Player
    {
        return new DefaultPlayer($this->startRoom);
    }

    /**
     * Make Rooms for the DefaultWorld
     * @return $this
     */
    protected function makeRooms(array $options): GameWorld
    {
        $this->rooms = $options['rooms'];
        $this->startRoom = $options['start'] ?? array_keys($this->rooms)[0];

        foreach ($this->rooms as $room => &$data) {
            $data['instance'] = RoomFactory::create($room);

            $this->makeThings($data);

            if ($this->startRoom === $data['instance']->name) {
                $this->startRoom = $data['instance'];
            }
        }

        return $this->makeAvailableRooms();
    }

    /**
     * Make Things for the selected room
     * @param array $roomData
     * @return $this
     */
    protected function makeThings(array $roomData): GameWorld
    {
        if (empty($roomData['things'])) {
            return $this;
        }

        foreach ($roomData['things'] as $thing => $count) {
            while ($count) {
                $roomData['instance']->addThing(ThingFactory::create($thing));
                --$count;
            }
        }
        return $this;
    }

    /**
     * Make relations of the selected room with those available for it
     * @return $this
     */
    protected function makeAvailableRooms(): GameWorld
    {
        foreach ($this->rooms as $room) {
            foreach ($room['availables'] as $availRoom) {
                $room['instance']->addAvailableRoom(
                    $this->rooms[$availRoom]['instance']
                );
            }
        }
        return $this;
    }
}
