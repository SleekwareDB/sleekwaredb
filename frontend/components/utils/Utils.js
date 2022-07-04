import { useEffect, useState } from "react";

export default function createRandomStat(min, max) {
    const [number, setNumber] = useState()
    useEffect(() => {
        const interval = setInterval(() => setNumber(Math.floor(Math.random() * (max - min + 1) + min)), 2000)
        return () => {
            clearInterval(interval)
        }
    }, [])
    return number
}
