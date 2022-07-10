FROM node:latest AS dependencies
RUN mkdir -p /home/app
WORKDIR /home/app
COPY package.json yarn.lock clean.sh ./
RUN chmod +x ./clean.sh && ./clean.sh
RUN yarn cache clean
RUN set http_proxy= \
    && set https_proxy= \
    && yarn config delete proxy \
    && npm config rm https-proxy \
    && npm config rm proxy \
    && npm config set registry "https://registry.npmjs.org"
RUN yarn install --network-timeout 1000000

FROM node:latest AS builder
WORKDIR /home/app
COPY . .
COPY --from=dependencies /home/app/node_modules ./node_modules

EXPOSE 3000
CMD ["yarn", "dev"]
