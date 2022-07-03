import Head from "next/head"
import '../styles/globals.css'

function MyApp({ Component, pageProps }) {
  return (
    <div>
      <Head>
        <meta charset="UTF-8" />
        <meta name="keywords" content="sleekdb, SleekwareDB" />
        <meta name="author" content="Imam Ali Mustofa" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      </Head>
      <Component {...pageProps} />
    </div>
  )
}

export default MyApp
