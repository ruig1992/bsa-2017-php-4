<?php

namespace BinaryStudioAcademy\Game\Worlds;

use BinaryStudioAcademy\Game\Contracts\Player;
use BinaryStudioAcademy\Game\Players\DefaultPlayer;

use BinaryStudioAcademy\Game\Rooms\RoomFactory;
use BinaryStudioAcademy\Game\Contracts\GameWorld;

class DefaultWorld extends AbstractWorld
{
    /**
     * Make Rooms for the DefaultWorld
     * @return $this
     */
    protected function makeRooms(array $options): GameWorld
    {
        $this->startRoom = $options['start'];
        $this->rooms = $options['rooms'];

        foreach ($this->rooms as $room => &$data) {
            $newRoom = RoomFactory::create($room);

            if (!empty($data['things'])) {
                foreach ($data['things'] as $thing => $count) {
                    $thing = "\BinaryStudioAcademy\Game\Things\\" . ucfirst($thing);
                    while ($count) {
                        $newRoom->addThing(new $thing);
                        --$count;
                    }
                }
            }

            $data['instance'] = $newRoom;
            if ($this->startRoom === $newRoom->name) {
                $this->startRoom = $newRoom;
            }
        }

        $this->makeAvailableRooms();

        return $this;
    }
    /**
     * Make Things for Rooms of the DefaultWorld
     * @return $this
     */
    protected function makeThings(): GameWorld
    {
        $hall->addThing(new Things\Coin);
        $basement->addThing(new Things\Coin)
            ->addThing(new Things\Coin);
        $cabinet->addThing(new Things\Coin);
        $bedroom->addThing(new Things\Coin);

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
    /**
     * Make the Player with the Room as his starting position in the Game
     * @return Player
     */
    public function makePlayer(): Player
    {
        return new DefaultPlayer($this->startRoom);
    }
}
