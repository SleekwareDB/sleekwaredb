import createRandomStat from "../utils/Utils"
export default function SystemStats() {
    const stats = [
        {
            "--value": createRandomStat(0, 100),
            "--size": "6rem",
            "label": "Disk Read",
            "styling": "radial-progress font-bold text-center bg-primary text-primary-content border-4 border-primary"
        },
        {
            "--value": createRandomStat(0, 100),
            "--size": "7rem",
            "label": "Disk Write",
            "styling": "radial-progress font-bold text-center bg-success text-success-content border-4 border-success"
        },
        {
            "--value": createRandomStat(0, 100),
            "--size": "10rem",
            "label": "CPU",
            "styling": "radial-progress font-bold text-center bg-warning text-warning-content border-4 border-warning"
        },
        {
            "--value": createRandomStat(0, 100),
            "--size": "7rem",
            "label": "Request",
            "styling": "radial-progress font-bold text-center bg-error text-error-content border-4 border-error"
        },
        {
            "--value": createRandomStat(0, 100),
            "--size": "6rem",
            "label": "Response",
            "styling": "radial-progress font-bold text-center bg-secondary text-secondary-content border-4 border-secondary"
        }
    ]

    return (
        <>
            <div className="grid grid-cols-5 my-5">
                {
                    stats.map((item, index) => {
                        return (
                            <div className="flex justify-center items-center" key={index}>
                                <div className={item.styling} style={item}>{item["--value"]}% <span className="text-sm">{item.label}</span></div>
                            </div>
                        )
                    })
                }
            </div>
        </>
    )
}
